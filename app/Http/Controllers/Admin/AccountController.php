<?php

/**
 * 账户相关
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\Traits\CommonResponse;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use App\Model\UserModel;
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

    public function login()
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'username'  => 'required',
            'password'  => 'required|between:6,50',
        ]);

        if($validate->fails()){
            return $this->ajaxError($validate->errors()->first());
        }

        $username = $request->get('username');
        $password = $request->get('password');

        try{
            $userInfo = UserModel::where(['username' => $username])->first();
        }catch (Exception $e){
             return $this->ajaxError($e->getMessage());
        }
        if(empty($userInfo)){
             return $this->ajaxError($username.'帐号不存在');
        }

        if(password_verify($password,$userInfo->password)){
            return $this->ajaxSuccess('登陆成功',['url' => route('admin.index')]);
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
