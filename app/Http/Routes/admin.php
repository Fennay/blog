<?php

/**
 * 管理后台路由配置
 */


/**
 * 监听二级域名：admin.xxx.com
 * 管理后台的Controller位于Controllers/Admin下
 */
Route::group(['domain' => env('APP_DOMAIN_ADMIN'), 'namespace' => 'Admin'], function () {
    //
});





