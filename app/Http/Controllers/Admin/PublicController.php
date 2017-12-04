<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/12/4 - 18:33
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class PublicController extends BaseController
{
    public function upload(Request $request)
    {
        $file = $request->file();
        p($file);die;
    }
}