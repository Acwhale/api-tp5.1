<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/19
 * Time: 15:48
 */

namespace app\api\model;


use think\Db;

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


    public static function myWishes($uid){
        return self::where('uid','=',$uid)->where('launched','=',0)
            ->order('create_time','desc')->select();
    }

    public static function getGiftsCount($isbnList){
        //Db::table('pet')->field('owner,count(*)')->group('owner')->select()
        return Db::table('gift')->field('isbn,count("isbn") AS giftCount')->where('status', '=',1)->
        where('launched','=',0)->whereIn('isbn',$isbnList)
            ->group('isbn')->order('create_time','desc')
            ->select();
    }
}