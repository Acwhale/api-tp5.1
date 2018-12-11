<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/10
 * Time: 17:04
 */

namespace app\validate;


class SearchValidate extends BaseValidate {
    protected $rule = [
        'q'=>'require|min:1|max:30',
        'page'=>'number|min:1|max:99'
    ];
    protected $message =[
        'q' => 'XD,检查一下',
        'page'=>'XD,输入的不对吧'
    ];
}