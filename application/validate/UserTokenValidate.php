<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 10:37
 */

namespace app\validate;


class UserTokenValidate extends BaseValidate {
    protected $rule = [
        'account'=>'require|email|max:32|min:5',
        'secret' =>'require|length:6,22',
    ];
    protected $message =[
        'account'=>'XD你输入的不对吧',
        'secret'=>'XD这是什么',
    ];
}