<?php

/**
 * 账户相关
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Traits\CommonResponse;
use Exception;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountController extends Authenticatable
{
    use CommonResponse;
    use HasRoles;
    protected $userObj;

    public function __construct(
        UserRepository $user
    )
    {
        $this->userObj = $user;
    }

    public function login(UserRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $userInfo = $this->userObj->getUserInfoByUserName($username);
        if(empty($userInfo)){
            return $this->ajaxError($username.'不存在');
        }

        if(password_verify($password,$userInfo->password)){
            return $this->ajaxSuccess('登陆成功');
        }

        return $this->ajaxError('用户名或密码不正确');
    }

    public function checkLogin()
    {

    }

    /**
     * 注册
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author: Mikey
     */
    public function register(UserRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $password = password_hash($password,PASSWORD_DEFAULT);
        $saveData = [
            'username' => $username,
            'password' => $password,
        ];

        try{
            $this->userObj->saveInfo($saveData);
        }catch (Exception $exception){
            return $this->ajaxError($exception->getMessage());
        }
        return $this->ajaxSuccess('注册成功');
    }
}
