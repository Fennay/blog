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

Route::get('/login',[
    'as' => 'login',
    'uses' => 'AccountController@login'
]);

Route::post('/register',[
    'as' => 'register',
    'uses' => 'AccountController@register'
]);
