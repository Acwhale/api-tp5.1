<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 16:49
 */

namespace app\libs\Exception;


class ParameterException extends BaseException {
    public $code = 400;
    public $msg = 'Parameter error';
    public $errCode = 10000;
}