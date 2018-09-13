<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 11:56
 */

namespace app\validate;


use app\libs\Exception\ParameterException;
use think\facade\Request;
use think\Validate;

class BaseValidate extends Validate {
    public function goCheck(){
        $params = Request::except('version');
        $result = $this->batch()->check($params);
        if(!$result){
            $e = new ParameterException([
                'msg'=>$this->error,
            ]);
            throw  $e;
        }
        return true;
    }
}