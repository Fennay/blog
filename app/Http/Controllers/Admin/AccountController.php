<?php

/**
 * 账户相关
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AccountController extends BaseController
{
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
        dd($password);
    }
}
