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
        return $this->belongsTo('User','uid','id');
    }
    public static function wishing($isbn,$id){
        return self::with(['user'])->where('isbn','=',$isbn)
            ->where('uid','=',$id)->where('launched','=',0)->find();
    }

    public static function getAllWishers($isbn){
        return self::with(['user'])->where('isbn','=',$isbn)->where('launched','=',0)->select();
    }
}