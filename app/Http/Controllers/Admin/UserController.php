<?php
/**
 * Created by PhpStorm.
 * User: Mikey
 * Date: 2017/11/22
 * Time: 23:31
 */

namespace App\Http\Controllers\Admin;

use App\Exceptions\BusinessException;
use App\Exceptions\HomeException;
use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use App\Traits\CommonResponse;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends BaseController
{
    use CommonResponse;
    /**
     * @var UserRepository
     */
    protected $userObj;


    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->userObj = $user;
    }

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function index()
    {
        $dataList = $this->userObj->getUserPageList(10);

        return view('admin.user.index', ['dataList' => $dataList]);
    }

    /**
     * 添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function add()
    {
        return view('admin.user.edit',['dataInfo' => collect()]);
    }

    /**
     * 编辑
     * @param $uid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function edit($uid)
    {
        $userInfo = $this->userObj->getUserInfoByUid($uid);

        return view('admin.user.edit', ['dataInfo' => $userInfo]);
    }

    /**
     * 删除
     * @param $uid
     * @return \Illuminate\Http\JsonResponse
     * @author: Mikey
     */
    public function del($uid)
    {
        try {
            $this->userObj->delUserByUid($uid);
        } catch (HomeException $exe) {
            return $this->ajaxError('删除失败');
        }

        return $this->ajaxSuccess('删除成功');
    }

    /**
     * 保存
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author: Mikey
     */
    public function save(UserRequest $request)
    {
        $saveData = $request->all();

        try {
            $this->userObj->saveInfo($saveData);
        } catch (BusinessException $exe) {
            return $this->ajaxError($exe->getMessage());
        }

        return $this->ajaxSuccess('保存成功', ['url' => route('userList')]);
    }

}