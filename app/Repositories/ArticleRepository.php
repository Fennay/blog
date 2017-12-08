<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/27 - 18:03
 */

namespace App\Repositories;

use App\Exceptions\BusinessException;
use App\Model\ArticleModel;
use App\Model\ArticleContentModel;
use App\Model\ArticleTagsModel;
use App\Services\BaiDuFanYiService;
use Exception;
use DB;

class ArticleRepository extends BaseRepository
{
    protected $articleModel;
    protected $articleContentModel;
    protected $articleTagsModel;
    protected $baiduFanyiService;

    public function __construct(
        ArticleModel $article,
        ArticleContentModel $articleContent,
        ArticleTagsModel $articleTagsModel,
        BaiDuFanYiService $baiDuFanYiService
    )
    {
        $this->articleModel = $article;
        $this->articleContentModel = $articleContent;
        $this->articleTagsModel = $articleTagsModel;
        $this->baiduFanyiService = $baiDuFanYiService;
    }

    /**
     * 保存数据
     * @param array $data
     * @return mixed
     * @throws BusinessException
     * @author: Mikey
     */
    public function saveArticle(array $data)
    {
        DB::beginTransaction();
        // 存储标签
        try {
            if (!empty($data['tags'])) {
                // 存储标签
                $newTag = $newTagId = $tagId = [];
                foreach ($data['tags'] as $vTag) {
                    if (!preg_match('/^[0-9]*$/', $vTag)) {
                        $newTag[] = $vTag;
                    } else {
                        $tagId[] = $vTag;
                    }
                }
                // 新的标签id
                $newTagId = $this->saveAllTag($newTag);
                // 合并已经存在的和新的标签id
                $tagId = array_merge($newTagId, $tagId);
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw new BusinessException($e->getMessage());
        }
        // 存储文章基本内容
        try {
            $saveInfo = [
                'id'        => empty($data['id']) ? '' : $data['id'],
                'title'     => $data['title'],
                'subhead'   => empty($data['subhead']) ? '' : $data['subhead'],
                'url'       => empty($data['url']) ? '' : $data['url'],
                'desc'      => empty($data['desc']) ? '' : $data['desc'],
                'img_url'   => empty($data['img_url']) ? '' : $data['img_url'],
                'author'    => empty($data['author']) ? '' : $data['author'],
                'author_id' => empty($data['author_id']) ? 0 : $data['author_id'],
                'tags_id'   => empty($tagId) ? '' : implode(',', $tagId),
                'status'    => empty($data['status']) ? 0 : $data['status']
            ];
            $this->articleModel->saveInfo($saveInfo);
            $aid = $this->articleModel->id;
        } catch (Exception $e) {
            DB::rollBack();
            throw new BusinessException($e->getMessage());
        }

        // 添加数据时，设置排序值等于Id
        if (empty($data['id'])) {
            try {
                $this->articleModel->saveInfo(['id' => $aid, 'sort' => $aid]);
            } catch (Exception $e) {
                DB::rollBack();
                throw new BusinessException($e->getMessage());
            }
        }

        // 保存内容
        try {
            $saveContent = [
                'id'      => empty($data['content_id']) ? '' : $data['content_id'],
                'aid'     => $aid,
                'content' => empty($data['content']) ? '' : $data['content']
            ];
            $this->articleContentModel->saveInfo($saveContent);
        } catch (Exception $e) {
            DB::rollBack();
            throw new BusinessException($e->getMessage());
        }

        // 提交事务
        DB::commit();
    }

    /**
     * 根据文章Id获取文章内容
     * @param $articleId
     * @return mixed
     * @author: Mikey
     */
    public function getArticleInfoByArticleId($articleId)
    {
        return $this->articleModel->getOne($articleId);
    }

    /**
     * 获取文章分页列表【后台】
     * @param int $pageSize
     * @return mixed
     * @author: Mikey
     */
    public function getAdminArticlePageList($pageSize = 10)
    {
        return $this->articleModel->getPageList([], $pageSize, ['sort' => 'desc', 'id' => 'desc']);
    }

    /**
     * 删除
     * @param $aid
     * @return mixed
     * @author: Mikey
     */
    public function delArticleByUid($aid)
    {
        return $this->articleModel->del($aid);
    }

    //+++++++++++++标签管理 Start++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    /**
     * 标签分页数据
     * @param $pageSize
     * @return mixed
     * @author: Mikey
     */
    public function getAdminArticleTagPageList($pageSize = 10)
    {
        return $this->articleTagsModel->getPageList([], $pageSize, ['sort' => 'desc', 'id' => 'desc']);
    }

    /**
     * 获取tag信息
     * @param $tagId
     * @return mixed
     * @author: Mikey
     */
    public function getTagInfoByTagId($tagId)
    {
        return $this->articleTagsModel->getOne($tagId);
    }

    /**
     * @param $data
     * @return mixed
     * @author: Mikey
     */
    public function saveTag($data)
    {
        $saveData = [
            'name'   => empty($data['name']) ? '' : $data['name'],
            'url'    => empty($data['url']) ? $data['name'] : $data['url'],
            'status' => empty($data['status']) ? 0 : $data['status'],
            'sort'   => empty($data['sort']) ? 0 : $data['sort'],
        ];

        return $this->articleTagsModel->saveInfo($saveData);
    }

    /**
     * 批量存储标签
     * @param $saveData
     * @return array|string
     */
    public function saveAllTag($saveData)
    {
        // 如果数组为空,则返回空
        if (empty($saveData)) {
            return [];
        }
        $rs = [];
        foreach ($saveData as $k => $v) {
            // 翻译URL
            try {
                $url = $this->baiduFanyiService->run($v);
            } catch (BusinessException $e) {
                $url = '';
            }

            $tmpData = [
                'name' => $v,
                'url'  => empty($url) ? $v : $url
            ];
            $this->articleTagsModel->saveInfo($tmpData);
            $rs[] = $this->articleTagsModel->id;
        }

        return $rs;
    }

    /**
     * 获取状态为1的标签
     * @return mixed
     * @author: Mikey
     */
    public function getTagsListWith1Status()
    {
        return $this->articleTagsModel->getList(['status' => 1]);
    }

    /**
     * 根据Ids获取标签信息
     * @param array $tagIds
     * @return mixed
     * @author: Mikey
     */
    public function getTagsListByTagIds(array $tagIds)
    {
        return $this->articleTagsModel->getList(['id' => ['in', $tagIds]]);
    }

    //*++++++++++++++标签管理 End++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

}