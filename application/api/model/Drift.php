<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/29
 * Time: 17:37
 */

namespace app\api\model;

class Drift extends BaseModel {
    public static function allDrift($userId){
        return self::whereOr('requester_id', '=',$userId)->whereOr('gifter_id','=',$userId)
            ->where('pending','=',2)
            ->order('create_time','desc')->select();
    }
}