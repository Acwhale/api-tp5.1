<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/27
 * Time: 13:41
 */

namespace app\validate;


class EmailValidate extends BaseValidate {
    protected $rule = [
        'email'=>'require|email|max:32|min:5',
    ];
    protected $message = [
        'email'=>'你输入的不是邮箱吧。',
    ];
}