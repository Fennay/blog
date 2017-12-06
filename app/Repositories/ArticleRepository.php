<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/27 - 18:03
 */

namespace App\Repositories;

use App\Exceptions\BusinessException;
use App\Model\Article;
use App\Model\ArticleContent;
use Exception;
use DB;

class ArticleRepository extends BaseRepository
{
    protected $articleModel;
    protected $articleContentModel;

    public function __construct(
        Article $article,
        ArticleContent $articleContent
    )
    {
        $this->articleModel = $article;
        $this->articleContentModel = $articleContent;
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
                'title'     => $data['title'],
                'subhead'   => empty($data['subhead']) ? '' : $data['subhead'],
                'desc'      => empty($data['desc']) ? '' : $data['desc'],
                'img_url'   => empty($data['img_url']) ? '' : $data['img_url'],
                'author'    => empty($data['author']) ? '' : $data['author'],
                'author_id' => empty($data['author_id']) ? 0 : $data['author_id'],
                'tag_id'    => empty($data['tag_id']) ? '' : $data['tag_id'],
                'status'    => empty($data['status']) ? 0 : $data['status']
            ];
            if(empty($data['id'])){
                DB::enableQueryLog();
                $aid = $this->articleModel->insertGetId($saveInfo);
                pd(DB::getQueryLog());
            }else{
                $aid = $data['id'];
                $saveInfo['id'] = $aid;
                $this->articleModel->saveInfo($saveInfo);
            }
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

}