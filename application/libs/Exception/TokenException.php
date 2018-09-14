<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 14:55
 */

namespace app\libs\Exception;


class TokenException extends BaseException {
    public $code = 401;
    public $msg = '无效token或者token失效';
    public $errCode = 10001;

}