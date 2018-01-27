<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/27 - 17:44
 */

namespace App\Http\Controllers\Admin;

use App\Repositories\ArticleRepository;
use App\Services\BaiDuFanYiService;
use App\Services\UploadService;
use App\Traits\CommonResponse;
use App\Http\Requests\ArticleRequest;
use App\Exceptions\HomeException;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    use CommonResponse;
    protected $articleObj;
    protected $uploadService;

    public function __construct(
        ArticleRepository $article,
        UploadService $uploadService
    )
    {
        $this->articleObj = $article;
        $this->uploadService = $uploadService;
    }

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function index()
    {
        $dataList = $this->articleObj->getAdminArticlePageList();
        // \DB::enableQueryLog();
        $tagsList = $this->articleObj->getTagsListWith1Status();
        // $sql = \DB::getQueryLog();
        // dd($sql,$tagsList);
        return view('admin.article.index', ['dataList' => $dataList]);
    }

    /**
     * 添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function add()
    {
        return view('admin.article.edit', [
            'dataInfo' => collect(),
            'tagsList' => $this->articleObj->getTagsListWith1Status()
        ]);
    }

    /**
     * 编辑
     * @param $aid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function edit($aid)
    {
        $dataInfo = $this->articleObj->getArticleInfoByArticleId(intval($aid));
        !empty($dataInfo->tags_id) && $dataInfo->tags_id = explode(',',$dataInfo->tags_id);
        return view('admin.article.edit', [
            'dataInfo' => $dataInfo,
            'tagsList' => $this->articleObj->getTagsListWith1Status()
        ]);
    }

    /**
     * 删除
     * @param $aid
     * @return \Illuminate\Http\JsonResponse
     * @author: Mikey
     */
    public function del($aid)
    {
        try {
            $this->articleObj->delArticleByUid($aid);
        } catch (HomeException $exe) {
            return $this->ajaxError('删除失败');
        }

        return $this->ajaxSuccess('删除成功', ['url' => route('articleList')]);
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

    /**
     * 保存
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author: Mikey
     */
    public function save(ArticleRequest $request)
    {
        $saveData = $request->all();

        !empty($saveData['img_url']) && $saveData['img_url'] = $this->uploadService->uploadSave($saveData['img_url']);
        try {
            $this->articleObj->saveArticle($saveData);
        } catch (HomeException $exe) {
            return $this->ajaxError($exe->getMessage());
        }

        return $this->ajaxSuccess('保存成功', ['url' => route('articleList')]);
    }
}