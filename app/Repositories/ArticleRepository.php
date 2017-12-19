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
use App\Exceptions\HomeException;

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
     * 通过文章Id获取文章
     * @param $articleId
     * @return mixed
     * Author: Fengguangyong
     */
    public function getArticleUrlById($articleId)
    {
        return $this->articleModel->getOne($articleId)->url;
    }

    /**
     * 通过URL获取文章
     * @param $url
     * @return mixed
     * Author: Fengguangyong
     */
    public function getArticleInfoByUrl($url)
    {
        $articleInfo = $this->articleModel->findOne(['url' => $url]);
        $articleInfo->content = $this->articleContentModel->findOne(['aid' => $articleInfo->id])['content'];

        return $articleInfo;
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

    /**
     * 获取状态为1的分页数据
     * @param int   $pageSize
     * @param array $order
     * @return mixed
     */
    public function getArticlePageListWith1Status($pageSize = 10, $order = [
        'sort' => 'desc',
        'id'   => 'desc'
    ])
    {
        return $this->articleModel->getPageList(['status' => 1], $pageSize, $order);
    }

    /**
     * 通过日期获取文章数据
     * @return array
     * Author: Mikey
     */
    public function getArticleListGroupByDate()
    {
        $data = $this->articleModel->getList(['status' => 1], 0, [
            'sort' => 'desc',
            'id'   => 'desc'
        ]);
        if (empty($data)) {
            return [];
        }

        $newData = [];
        foreach ($data as $k => $v) {
            $tmp['title'] = $v['title'];
            $tmp['url'] = $v['url'];
            $newData[$v->created_at->toDateString()][] = $tmp;
        }

        return $newData;
    }

    /**
     * 点击次数
     * @param $articleId
     * @return mixed
     * @throws HomeException
     */
    public function addClicks($articleId)
    {
        // 如果为空,则返回空数组
        if (empty($articleId)) {
            throw new HomeException('参数错误');
        }

        return $this->articleModel->where(['url' => $articleId])->increment('clicks', 1);
    }

    /**
     * 通过标签名称获取文章列表
     * @param $tag
     * @return array
     * @throws HomeException
     */
    public function getArticleListByTag($tag)
    {
        try {
            $tagId = $this->getTagIdByTagName($tag);
            if (empty($tagId)) {
                throw new HomeException('标签不存在');
            }
        } catch (HomeException $exe) {
            throw new HomeException($exe->getMessage());
        }

        try {
            $where = [];
            $where['tag_id'] = ['like', '%' . $tagId . '%'];

            $data = $this->articleModel->getList($where, 0, ['sort' => 'desc', 'id' => 'desc']);
        } catch (HomeException $exe) {
            throw new HomeException($exe->getMessage());
        }

        return $data;
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
     * @param int   $size
     * @param array $order
     * @return mixed
     * @author: Mikey
     */
    public function getTagsListWith1Status($size = 0, $order = ['sort' => 'desc', 'id' => 'desc'])
    {
        return $this->articleTagsModel->getList(['status' => 1], $size, $order);
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

    /**
     * 通过标签名称获取标签ID
     * @param $tagName
     * @return mixed
     * @throws HomeException
     */
    public function getTagIdByTagName($tagName)
    {
        // 判断是否为空
        if (empty($tagName)) {
            throw new HomeException('标签名不能为空');
        }

        return $this->articleTagsModel->findOne(['name' => $tagName, 'status' => 1])['id'];
    }

    //*++++++++++++++标签管理 End++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

}