<?php
/**
 * Created by PhpStorm.
 * User: Mikey
 * Date: 2017/11/20
 * Time: 21:08
 */
// 登陆
Route::get('/login', ['as' => 'login', 'uses' => 'AccountController@login']);
Route::post('/doLogin', ['as' => 'doLogin', 'uses' => 'AccountController@doLogin']);
Route::any('/register', ['as' => 'register', 'uses' => 'AccountController@register']);
// 上传图片
Route::any('/upload', ['as' => 'upload', 'uses' => 'PublicController@upload']);
// URL中文转换成英文
Route::any('/url2English', ['as' => 'url2English', 'uses' => 'PublicController@url2English']);

// 首页
Route::get('/', ['as' => 'admin.index', 'uses' => 'IndexController@index']);

// 用户
Route::group(['prefix' => '/user'], function () {
    Route::get('/', ['as' => 'userList', 'uses' => 'UserController@index']);
    Route::get('/add', ['as' => 'userAdd', 'uses' => 'UserController@add']);
    Route::get('/edit/{id}', ['as' => 'userEdit', 'uses' => 'UserController@edit']);
    Route::post('/save', ['as' => 'userSave', 'uses' => 'UserController@save']);
    Route::any('/del/{id}', ['as' => 'userDel', 'uses' => 'UserController@del']);
});

// 文章管理
Route::group(['prefix' => '/article'], function () {
    Route::get('/', ['as' => 'articleList', 'uses' => 'ArticleController@index']);
    Route::get('/add', ['as' => 'articleAdd', 'uses' => 'ArticleController@add']);
    Route::get('/edit/{id}', ['as' => 'articleEdit', 'uses' => 'ArticleController@edit']);
    Route::post('/save', ['as' => 'articleSave', 'uses' => 'ArticleController@save']);
    Route::delete('/del/{id}', ['as' => 'articleDel', 'uses' => 'ArticleController@del']);
    Route::any('/getArticleUrl', ['as' => 'getArticleUrl', 'uses' => 'ArticleController@getArticleUrl']);
});
// 标签管理
Route::group(['prefix' => '/tags'], function () {
    Route::get('/', ['as' => 'tagsList', 'uses' => 'ArticleTagsController@index']);
    Route::get('/add', ['as' => 'tagsAdd', 'uses' => 'ArticleTagsController@add']);
    Route::get('/edit/{id}', ['as' => 'tagsEdit', 'uses' => 'ArticleTagsController@edit']);
    Route::post('/save', ['as' => 'tagsSave', 'uses' => 'ArticleTagsController@save']);
    Route::delete('/del/{id}', ['as' => 'tagsDel', 'uses' => 'ArticleTagsController@del']);
    Route::any('/getArticleTagsUrl', ['as' => 'getArticleTagsUrl', 'uses' => 'ArticleTagsController@getArticleTagsUrl']);
});