<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/10
 * Time: 17:04
 */

namespace app\validate;


class PageValidate extends BaseValidate {
    protected $rule = [
        'page'=>'number'
    ];
    protected $message =[
        'page'=>'XD,输入的不对吧'
    ];
}