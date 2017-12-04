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
        /*
         * - 检查临时目录，正式目录是否设置，是否有权限
         * - 验证格式类型
         * - 验证图片大小
         * - 判断图片是否存在，存在则直接返回（判断方式-md5）
         * - 存储图片
         * - 根据日期设置文件名称
         * - 从临时目录转移到正式目录
         * - 返回图片URL
         */
        p($file);die;
    }
}