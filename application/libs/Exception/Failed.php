<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 9:54
 */

namespace app\libs\Exception;


class Failed extends BaseException {
    public $code = 409;
    public $msg = 'create resource failed';
    public $errCode = 20000;
}