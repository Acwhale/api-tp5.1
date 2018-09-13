<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 16:50
 */

namespace app\libs\Exception;


use think\exception\Handle;

class ExceptionHandler  extends Handle {
    private $code;
    private $msg;
    private $errCode;
    public function render(\Exception $e) {
       if($e instanceof BaseException){
           $this->code = $e->code;
           $this->msg =$e->msg;
           $this->errCode = $e->errCode;
       }else{
           $this->code = 500;
           $this->msg ='Server exception';
           $this->errCode = 999;
       }
       return json([
           'msg'=>$this->msg,
           'error_code'=>$this->errCode,
           'url'=>request()->url()
       ]);
    }
}