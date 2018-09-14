<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 9:46
 */

namespace app\libs\Exception;


class Success extends BaseException {
    public $code =201;
    public $msg ='OK';
    public $errCode ='0';
}