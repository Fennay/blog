<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as'   => 'home.index','uses' => 'IndexController@index']);
// 详情页
Route::get('/{articleId}', ['as' => 'articleDetail', 'uses' => 'IndexController@detail']);
//通过标签获取文章列表
Route::get('/tag/{tag}', ['as' => 'tag', 'uses' => 'IndexController@tag']);
