<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/21
 * Time: 15:15
 */

namespace app\api\service;

use app\api\model\Wish as WishModel;
use app\libs\Exception\GiftOrWishException;
use app\libs\Exception\Success;

class Wish {
    public static function saveToWish($isbn,$id){

        $wishing = WishModel::wishing($isbn,$id);
        if(!$wishing){
            $wish = new WishModel();
            $wish->isbn = $isbn;
            $wish->uid = $id;
            $wish->save();
            if($wish->id){
                return (new Success([
                    'code'=>200,
                    'msg'=>"添加心愿成功"
                ]));
            }
        }else{
            throw new GiftOrWishException([
                'msg'=>'不可以同时成为书籍的赠送者/索要者'
            ]);
        }
    }
}