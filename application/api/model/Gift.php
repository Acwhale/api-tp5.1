<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/13
 * Time: 17:04
 */

namespace app\api\model;


use think\Db;

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

    public static function recent(){
        $recentCount = config('base.recent') ? config('base.recent') : 30;
        return self::where('launched','=','0')->group('isbn')
            ->order('create_time','desc')
            ->limit($recentCount)->distinct('isbn')->select();
    }

    public static function myGift($uid){
        return self::where('uid','=',$uid)->where('launched','=',0)
                ->order('create_time','desc')->select();
    }

    public static function getWishCount($isbnList){
        //Db::table('pet')->field('owner,count(*)')->group('owner')->select()
        return Db::table('wish')->field('isbn,count("isbn") AS wishesCount')->where('status', '=',1)->
        where('launched','=',0)->whereIn('isbn',$isbnList)
            ->group('isbn')->order('create_time','desc')
            ->select();
    }

    public static function getGiftById($id){
        return self::where('id','=',$id)->find();
    }
    public static function getGiftAndUserById($id){
        return self::with(['user'])->where('id','=',$id)->find();
    }
    public static function isYourselfGift($userId,$giftUid){
        return $userId == $giftUid ? true : false;
     }
}