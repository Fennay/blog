<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/27 - 17:02
 */

namespace App\Http\Controllers\Admin;

class IndexController extends BaseController
{
    public function index()
    {
        return view('admin.index');
    }
}