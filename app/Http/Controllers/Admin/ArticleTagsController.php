<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/12/8 - 16:17
 */

namespace App\Http\Controllers\Admin;

use App\Repositories\ArticleRepository;
use App\Services\BaiDuFanYiService;
use App\Traits\CommonResponse;
use App\Exceptions\HomeException;
use Illuminate\Http\Request;

class ArticleTagsController extends BaseController
{
    use CommonResponse;
    protected $articleObj;

    public function __construct(
        ArticleRepository $article
    )
    {
        $this->articleObj = $article;
    }

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function index()
    {
        $dataList = $this->articleObj->getAdminArticleTagPageList();

        return view('admin.tags.index', ['dataList' => $dataList]);
    }

    /**
     * 添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function add()
    {
        return view('admin.tags.edit', [
            'dataInfo' => collect(),
            'tagsList' => $this->articleObj->getTagsListWith1Status()
        ]);
    }

    /**
     * 编辑
     * @param $tagId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function edit($tagId)
    {
        $dataInfo = $this->articleObj->getTagInfoByTagId($tagId);
        $dataInfo->tags_id = explode(',',$dataInfo->tags_id);
        return view('admin.tags.edit', [
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
            $this->articleObj->delArticleTagByUid($aid);
        } catch (HomeException $exe) {
            return $this->ajaxError('删除失败');
        }

        return $this->ajaxSuccess('删除成功', ['url' => route('articleList')]);
    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author: Mikey
     */
    public function save(Request $request)
    {
        $saveData = $request->all();

        try {
            $this->articleObj->saveTag($saveData);
        } catch (HomeException $exe) {
            return $this->ajaxError($exe->getMessage());
        }

        return $this->ajaxSuccess('保存成功', ['url' => route('tagsList')]);
    }
}