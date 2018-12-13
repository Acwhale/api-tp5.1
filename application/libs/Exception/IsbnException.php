<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/13
 * Time: 15:32
 */

namespace app\libs\Exception;


class IsbnException extends BaseException {
    public $code = 403;
    public $msg ='disable access';
    public $errCode = 1002;
}