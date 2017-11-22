<?php
/**
 * Created by PhpStorm.
 * User: Mikey
 * Date: 2017/11/20
 * Time: 21:08
 */

Route::get('/', function () {
    echo '这里是后台';
});

//Route::any('/login',[
//    'as' => 'login',
//    'uses' => 'AccountController@login'
//]);
//
//Route::any('/register',[
//    'as' => 'register',
//    'uses' => 'AccountController@register'
//]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
