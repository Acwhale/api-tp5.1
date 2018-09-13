<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 11:55
 */

namespace app\validate;


class UserEmailForm  extends BaseValidate {
    protected $rule = [
        'account'=>'require|email|max:32|min:5',
        'secret'=>'require|length:6,22',
        'nickname'=>'require|length:2,22',
        'type'=>'require|number'
    ];
    protected $message =[
        'account'=>'你输入的不是邮箱吧。',
        'secret'=>'你输入的太长或者太短了',
        'nickname'=>'昵称不对，换个姿势',
        'type'=>'输入的不是数字吧'
    ];
}