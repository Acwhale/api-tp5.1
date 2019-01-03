<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2019/1/3
 * Time: 15:00
 */

namespace app\libs\Exception;


class IsYourselfGiftException  extends BaseException {
    public $code = 403;
    public $msg ="This is your own book. You can't ask for it.";
    public $errCode = 1005;
}