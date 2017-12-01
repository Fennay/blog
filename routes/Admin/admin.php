<?php
/**
 * Created by PhpStorm.
 * User: Mikey
 * Date: 2017/11/20
 * Time: 21:08
 */

// 首页
Route::get('/', ['as' => 'admin.index', 'uses' => 'IndexController@index']);
// 登陆
Route::get('/login', ['as' => 'login', 'uses' => 'AccountController@login']);
Route::post('/doLogin', ['as' => 'doLogin', 'uses' => 'AccountController@doLogin']);
Route::any('/register', ['as'   => 'register','uses' => 'AccountController@register']);

// 用户
Route::group(['prefix' => '/user'], function () {
    Route::get('/', ['as' => 'userList', 'uses' => 'UserController@index']);
    Route::get('/add', ['as' => 'userAdd', 'uses' => 'UserController@add']);
    Route::get('/edit/{id}', ['as' => 'userEdit', 'uses' => 'UserController@edit']);
    Route::post('/save', ['as' => 'userSave', 'uses' => 'UserController@save']);
    Route::any('/del/{id}', ['as' => 'userDel', 'uses' => 'UserController@del']);
});

Route::group(['prefix' => '/article'],function(){
    Route::get('/',['as' => 'articleList','uses' => 'ArticleController@index']);
});