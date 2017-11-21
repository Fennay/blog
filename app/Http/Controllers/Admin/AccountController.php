<?php

/**
 * 账户相关
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Traits\CommonResponse;
use Illuminate\Http\Request;
use Exception;

class AccountController extends BaseController
{
    use CommonResponse;
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

        $check = password_verify($password,'$2y$10$i3LUG8G/YC.5KIpBnpeyR.tteo/i.YQWsohBe0x4ZVzS.My1mkpt6');

    }

    public function checkLogin()
    {

    }

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
