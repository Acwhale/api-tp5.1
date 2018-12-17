<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/17
 * Time: 14:07
 */

namespace app\validate;


class LoginByEmailValidate extends  BaseValidate {
    protected $rule = [
        'account'=>'require|email|max:32|min:5',
        'secret'=>'require|length:6,22',
        'type'=>'require|number'
    ];
    protected $message =[
        'account'=>'你输入的不是邮箱吧。',
        'secret'=>'你输入的太长或者太短了',
        'type'=>'输入的不是数字吧'
    ];
}