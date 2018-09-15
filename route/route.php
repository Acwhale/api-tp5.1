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
Route::get('api/:version/book','api/:version.book/getBook');
Route::post('api/:version/client','api/:version.client/createClient');


Route::post('api/:version/token/user','api/:version.token/getAccountToken');


Route::get('api/:version/user/:id','api/:version.user/getUser');
Route::delete('api/:version/deleteUser','api/:version.user/deleteUser');
return [

];

