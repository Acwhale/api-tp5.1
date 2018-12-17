<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/17
 * Time: 17:55
 */

namespace app\libs\Exception;



class ForbiddenException extends BaseException {
    public $code = 403;
    public $msg ='forbidden access';
    public $errCode = '10007';
}