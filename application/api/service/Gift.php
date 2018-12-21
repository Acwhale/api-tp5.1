<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/19
 * Time: 16:53
 */

namespace app\api\service;

use app\api\model\Gift as GiftModel;
use app\api\model\Wish as WishModel;
use app\api\model\User as UserModel;
use app\libs\Exception\GiftOrWishException;
use app\libs\Exception\NotFoundException;
use app\libs\Exception\Success;
use think\Db;
use think\Exception;

class Gift {
    /**
     * @param $isbn
     * @param $id
     * @return array|\PDOStatement|string|\think\Model|null
     * @throws Exception
     * @throws GiftOrWishException
     * @throws NotFoundException
     */
    public static function saveToGift($isbn,$id){
        $book = (new HttpHelper())->get($isbn,1);
        if(!$book){
            throw new NotFoundException();
        }
        $gifting = GiftModel::gifting($isbn,$id);
//        $wishing = WishModel::wishing($isbn);

        if(!$gifting){
            Db::startTrans();
               try{
                   $gift = new GiftModel();
                   $gift->isbn = $isbn;
                   $gift->uid = $id;
                   $gift->save();
                   if($gift->id){
                       $user = UserModel::getUserById($id);
                       $beans = config('base.beans');
                       $user->beans += $beans;
                       $user->save();
                       Db::commit();
                       return (new Success([
                           'code'=>200,
                           'msg'=>"添加礼物成功"
                       ]));
                   }
               }catch (Exception $e){
                   Db::rollback();
                   throw  $e;
               }
        }else{
            throw new GiftOrWishException([
                'msg'=>'不可以同时成为书籍的赠送者/索要者'
            ]);
        }

    }
}