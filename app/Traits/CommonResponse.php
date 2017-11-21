<?php

/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/9/26 - 15:33
 */

namespace App\Traits;


trait CommonResponse
{

    /**
     * 成功返回
     * @param null $info
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     * @author: Fengguangyong
     */
    public function ajaxSuccess($info = null, $data = null)
    {
        return $this->jsonResponse('success', $info, $data);
    }

    /**
     * 失败返回
     * @param null $info
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     * @author: Fengguangyong
     */
    public function ajaxError($info = null, $data = null)
    {
        return $this->jsonResponse('error', $info, $data);
    }

    /**
     * 通用返回方法
     * @param $status
     * @param $info
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @author: Fengguangyong
     */
    protected function jsonResponse($status, $info = null, $data = null)
    {
        return response()->json([
            'status' => $status,
            'info'   => is_null($info) ? '' : $info,
            'data'   => is_null($data) ? '' : $data
        ]);
    }

    /**
     * jsonp返回
     * @param      $callback
     * @param      $status
     * @param null $info
     * @param null $data
     * @return $this
     * @author: Mikey
     */
    public function jsonpResponse($callback, $status, $info = null, $data = null)
    {
        return $this->jsonResponse($status, $info, $data)->setCallback($callback);
    }
}