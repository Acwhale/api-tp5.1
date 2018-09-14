<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 10:56
 */

namespace app\libs\Exception;


class NotFoundException extends BaseException {
    public $code = 404;
    public $msg ='the resource are not found 0__0...';
    public $errCode = 1001;
}