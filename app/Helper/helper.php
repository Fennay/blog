<?php
/**
 * Created by PhpStorm.
 * Author: Fengguangyong
 * Date: 2017/11/21 - 15:32
 */

if (!function_exists('p')) {
    function p($data)
    {
        echo '<pre>';
        print_r($data);
    }
}

if (!function_exists('pd')) {
    function pd($data)
    {
        echo '<pre>';
        print_r($data);
        die;
    }
}
if (!function_exists('randCssClass')) {
    function randCssClass()
    {
        $arr = ['success', 'info', 'danger', 'warning'];
        $count = count($arr);

        return $arr[mt_rand(0, $count - 1)];
    }
}

if (!function_exists('randColor')) {
    function randColor()
    {
        $str = '456789ABCDEF';
        $returnStr = '#';
        for($i = 0;$i<6;$i++){
            $returnStr .= $str[mt_rand(0,6)];
        }
        return $returnStr;
    }
}

if (!function_exists('getStatus')) {
    function getStatus($id)
    {
        list($str, $info) = 1 == $id ? ['success', '开启'] : ['danger', '关闭'];

        return '<span class="label label-sm label-' . $str . '">' . $info . '</span>';
    }
}