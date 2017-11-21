<?php

/**
 * 账户相关
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Validator;

class AccountController extends BaseController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        $username = $request->get('username');
        $password = $request->get('password');

    }

    public function checkLogin()
    {

    }

    public function register()
    {

    }
}
