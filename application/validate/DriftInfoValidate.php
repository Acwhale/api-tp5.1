<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2019/1/4
 * Time: 16:14
 */

namespace app\validate;


class DriftInfoValidate extends BaseValidate {
    protected $rule = [
        'recipientName'=>'require|min:2|max:20',
        'mobile'=>'require|mobile',
        'message'=>'require',
        'address'=>'require|min:10|max:70'
    ];
    protected $message = [
        'recipientName' => '请输入2-20个字符',
        'mobile' => '请输入正确的手机号',
        'message' => '请给你的寄书人留一段言吧',
        'address' => '请尽量把地址写详细'
    ];
}