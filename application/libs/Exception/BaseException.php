<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 16:30
 */

namespace app\libs\Exception;


use think\Exception;

class BaseException  extends  Exception {
    public $code = 404;
    public $msg ='Parameter error';
    public $errCode = 10000;
    public function __construct($params=[]) {
        if(!is_array($params)){
            return;
        }
        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errCode',$params)){
            $this->errCode = $params['errCode'];
        }
    }
}