<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/19
 * Time: 15:48
 */

namespace app\api\model;


class Wish extends BaseModel {
    public function user () {
        return $this->belongsToMany('User','user','id');
    }
}