<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/13
 * Time: 17:04
 */

namespace app\api\model;


class Gift extends BaseModel {

    public function user () {
        return $this->belongsToMany('User','user','id');
    }
}