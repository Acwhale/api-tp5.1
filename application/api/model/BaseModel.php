<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 13:57
 */

namespace app\api\model;


use think\Model;

class BaseModel  extends Model {
    public $autoWriteTimestamp = true;

}