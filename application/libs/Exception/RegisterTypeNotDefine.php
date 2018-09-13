<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 17:58
 */

namespace app\libs\Exception;


class RegisterTypeNotDefine extends BaseException {
    public $code = 400;
    public $msg =  'The registration method is not defined';
    public $errCode = 1006;
}