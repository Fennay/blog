<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/27 - 17:44
 */

namespace App\Http\Controllers\Admin;

use App\Repositories\ArticleRepository;
use App\Traits\CommonResponse;
use App\Http\Requests\ArticleRequest;

class ArticleController extends BaseController
{
    use CommonResponse;
    protected $articleObj;

    public function __construct(
        ArticleRepository $article
    )
    {
        $this->articleObj = $article;
    }

    public function index()
    {
        $dataList = $this->articleObj->getAdminArticlePageList();

        return view('admin.article.index', ['dataList' => $dataList]);
    }

    public function add()
    {
        return view('admin.article.edit',['dataInfo' => collect()]);
    }

    public function edit()
    {
        return view('admin.article.edit',['dataInfo' => collect()]);

    }

    public function del($aid)
    {
        try {
            $this->articleObj->delArticleByUid($aid);
        } catch (HomeException $exe) {
            return $this->ajaxError('删除失败');
        }

        return $this->ajaxSuccess('删除成功');
    }

    /**
     * 排序，上移
     * @author: Mikey
     */
    public function up()
    {

    }

    /**
     * 排序，下移
     * @author: Mikey
     */
    public function down()
    {

    }

    public function save(ArticleRequest $request)
    {
        $saveData = $request->all();
        p($request->file());
        p($saveData);die;
        try {
            $this->userObj->saveInfo($saveData);
        } catch (BusinessException $exe) {
            return $this->ajaxError($exe->getMessage());
        }

        return $this->ajaxSuccess('保存成功', ['url' => route('userList')]);
    }


}