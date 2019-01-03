<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2019/1/3
 * Time: 16:06
 */

namespace app\libs\Exception;


class BeansNotEnoughException  extends BaseException {
    public $code = 403;
    public $msg ="not enough";
    public $errCode = 1005;
}