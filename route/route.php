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
//保存礼物
Route::post('api/:version/gift/save','api/:version.gift/saveToGift');
//添加心愿
Route::post('api/:version/wish/save','api/:version.wish/saveToWish');
//所有isbn书籍的索要者
Route::get('api/:version/givers/all/:isbn','api/:version.gift/givers');
//所有isbn书籍的心愿者
Route::get('api/:version/wishers/all/:isbn','api/:version.wish/wishers');
//获取最近的礼物
Route::get('api/:version/gift/recent','api/:version.gift/recent');
//获取我的礼物的心愿
Route::get('api/:version/gift/:id/my','api/:version.gift/gifts');
Route::get('api/:version/wish/:id/my','api/:version.wish/wishes');

//注销
Route::post('api/:version/user/logout','api/:version.user/logout');

Route::post('api/:version/token/user','api/:version.token/getAccountToken');


Route::get('api/:version/user/:id','api/:version.user/getUser');
Route::post('api/:version/user/reset','api/:version.user/resetPassword');

Route::delete('api/:version/deleteUser','api/:version.user/deleteUser');
Route::get('api/:version/info','api/:version.user/info');
Route::delete('api/:version/super/delete/:id','api/:version.user/superDelete');
return [

];

