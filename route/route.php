<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

//搜索书籍
Route::get('api/:version/book','api/:version.book/search');
//书籍详情
Route::get('api/:version/:isbn/bookDetail','api/:version.book/bookDetail');
//用户注册
Route::post('api/:version/client','api/:version.client/createClient');
//用户登录
Route::post('api/:version/login','api/:version.user/login');
//获取token
Route::post('api/:version/user/token','api/:version.user/getToken');

Route::post('api/:version/token/user','api/:version.token/getAccountToken');


Route::get('api/:version/user/:id','api/:version.user/getUser');


Route::delete('api/:version/deleteUser','api/:version.user/deleteUser');
Route::delete('api/:version/super/delete/:id','api/:version.user/superDelete');
return [

];

