<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/22 - 10:32
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class HomeException extends Exception
{
    /**
     * 前台错误，显示404
     *开发环境显示错误提示
     * @param Request $request
     * @param         $e
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @author: Mikey
     */
    static public function homeRender(Request $request, Exception $e)
    {
        if (!env('APP_DEBUG')) {
            return response()->view("errors.404", [], 404);
        } else {
            return response($e->getMessage());
        }
    }
}