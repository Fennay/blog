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
use App\Model\UserModel;

class AccountController extends BaseController
{
    use CommonResponse;
    use HasRoles;
    protected $userObj;

    public function __construct(
        UserRepository $user
    ) {
        $this->userObj = $user;
    }

    public function login(UserRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        try {
            // $userInfo = $this->userObj->getUserInfoByUserName($username);
            $userInfo = UserModel::where(['username' => $username])->first();
        } catch (Exception $e) {
            // return response()->json(['info' => $e->getMessage()],200);
            return response($e->getMessage(), '200');
            // return $this->ajaxError($username.'不存在');
        }
        if (empty($userInfo)) {
            // return $this->ajaxError($username.'不存在');
            // return response($username.'账户不存在','200');
            // return response();
            return response()->json(['error' => ['message' => $username . '账户不存在']], 422);
        }

        if (password_verify($password, $userInfo->password)) {
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

        $password = password_hash($password, PASSWORD_DEFAULT);
        $saveData = [
            'username' => $username,
            'password' => $password,
        ];

        try {
            $this->userObj->saveInfo($saveData);
        } catch (Exception $exception) {
            return $this->ajaxError($exception->getMessage());
        }

        return $this->ajaxSuccess('注册成功');
    }
}
