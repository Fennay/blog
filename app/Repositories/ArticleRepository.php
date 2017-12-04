<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/27 - 18:03
 */

namespace App\Repositories;

use App\Exceptions\BusinessException;
use App\Model\Article;
use Exception;

class ArticleRepository extends BaseRepository
{
    protected $articleModel;

    public function __construct(Article $article)
    {
        $this->articleModel = $article;
    }

    /**
     * 保存数据
     * @param $saveInfo
     * @return mixed
     * @throws BusinessException
     * @author: Mikey
     */
    public function saveInfo($saveInfo)
    {
        try {
            return $this->articleModel->saveInfo($saveInfo);
        } catch (Exception $e) {
            throw new BusinessException($e->getMessage());
        }
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

}