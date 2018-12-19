<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/19
 * Time: 16:53
 */

namespace app\api\service;

use app\api\model\Gift as GiftModel;
use app\api\model\User as UserModel;
use app\libs\Exception\NotFoundException;

class Gift {
    public static function saveToGift($isbn,$id){
        $book = (new HttpHelper())->get($isbn,1);
        if(!$book){
            throw new NotFoundException();
        }
        print_r( UserModel::gifting()); die();
        $gift = new GiftModel();

        $gift->isbn = $isbn;
        $gift->uid = $id;
        $gift->save();
        if($gift->id){
            $user = UserModel::getUserById($id);
            $beans = config('base.beans');
            $user->beans += $beans;
            $user->save();
            return $user;
        }
    }
}