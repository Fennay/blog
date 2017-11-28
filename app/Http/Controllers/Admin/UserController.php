<?php
/**
 * Created by PhpStorm.
 * User: Mikey
 * Date: 2017/11/22
 * Time: 23:31
 */

namespace App\Http\Controllers\Admin;


class UserController extends BaseController
{

    public function index()
    {
        return view('admin.user.index');
    }

    public function save()
    {

    }

}