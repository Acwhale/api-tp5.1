<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 16:11
 */

namespace app\validate;


class IDMustNumeric  extends BaseValidate {
    protected $rule = [
        'id'=>'require|number'
    ];
    protected $message =[
        'id'=>'XD,输入的不对吧'
    ];
}