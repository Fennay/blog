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
use Illuminate\Http\Request;
use Validator;

class AccountController extends BaseController
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

    /**
     * 登陆
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author: Mikey
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * 登陆
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author: Mikey
     */
    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->ajaxError($validator->messages()->first());
        }
        $username = $request->get('username');
        $password = $request->get('password');

        try {
            $userInfo = UserModel::where(['username' => $username])->first();
        } catch (Exception $e) {
            return $this->ajaxError($e->getMessage());
        }
        if (empty($userInfo)) {
            return $this->ajaxError($username . '帐号不存在');
        }

        if (password_verify($password, $userInfo->password)) {
            session([
                'username' => $username,
                'uid'      => $userInfo->id
            ]);

            return $this->ajaxSuccess('登陆成功', ['url' => route('admin.index')]);
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
