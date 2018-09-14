<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 11:08
 */

namespace app\libs\Exception;


class AuthFailedException extends BaseException {
    public $code = 401;
    public $msg ='authorization failed';
    public $errCode = 1005;
}