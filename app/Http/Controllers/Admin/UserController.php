<?php
/**
 * Created by PhpStorm.
 * User: Mikey
 * Date: 2017/11/22
 * Time: 23:31
 */

namespace App\Http\Controllers\Admin;

use App\Exceptions\BusinessException;
use App\Repositories\UserRepository;

use App\Http\Requests\UserRequest;
use App\Traits\CommonResponse;

class UserController extends BaseController
{
    use CommonResponse;
    protected $userObj;

    public function __construct(UserRepository $user)
    {
        $this->userObj = $user;
    }

    public function index()
    {
        $dataList = $this->userObj->getUserPageList();

        return view('admin.user.index', ['dataList' => $dataList]);
    }

    public function add()
    {
        return view('admin.user.edit');
    }

    public function edit()
    {

    }

    public function del()
    {

    }

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