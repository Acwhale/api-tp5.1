<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/20
 * Time: 10:56
 */

namespace app\libs\Exception;


class GiftOrWishException extends BaseException {
    public $code = 403;
    public $msg ='';
    public $errCode = 1008;
}