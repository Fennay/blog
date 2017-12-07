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
use Exception;
use DB;

class ArticleRepository extends BaseRepository
{
    protected $articleModel;
    protected $articleContentModel;
    protected $articleTagsModel;

    public function __construct(
        ArticleModel $article,
        ArticleContentModel $articleContent,
        ArticleTagsModel $articleTagsModel
    )
    {
        $this->articleModel = $article;
        $this->articleContentModel = $articleContent;
        $this->articleTagsModel = $articleTagsModel;
    }

    /**
     * 保存数据
     * @param array $data
     * @return mixed
     * @throws BusinessException
     * @author: Mikey
     */
    public function saveInfo(array $data)
    {
        DB::beginTransaction();
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
                'tag_id'    => empty($data['tag_id']) ? '' : $data['tag_id'],
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

    public function tagSave($data)
    {
        $saveData = [
            'name' => empty($data['name']) ? '' : $data['name'],
            'url' => empty($data['url']) ? '' : $data['url'],
            'status' => empty($data['status']) ? 0 : $data['status'],
            'sort' => empty($data['sort']) ? 0 : $data['sort'],
        ];
        return $this->articleTagsModel->saveInfo($saveData);
    }

    //*++++++++++++++标签管理 End++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

}