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
        return $this->belongsTo('User','uid','id');
    }

    public static function gifting($isbn,$id){
        return self::with(['user'])->where('isbn','=',$isbn)
            ->where('uid','=',$id)->where('launched','=',0)->find();
    }
    public static function getAllGivers($isbn){
        return self::with(['user'])->where('isbn','=',$isbn)->where('launched','=',0)->select();
    }
    public static function hasInGift($isbn){
        return self::where('isbn','=',$isbn)->where('launched','=',0)->find();
    }
}