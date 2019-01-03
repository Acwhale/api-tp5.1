<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2019/1/3
 * Time: 13:51
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\Token as TokenService;
use app\libs\Exception\BeansNotEnoughException;
use app\libs\Exception\IsYourselfGiftException;
use app\libs\Exception\TokenException;
use app\validate\IDMustNumeric;
use app\api\model\Gift as GiftModel;
use app\api\model\User as UserModel;

class Drift extends BaseController {
    public function sendDrift($id = ''){
        $UserId = TokenService::getCurrentUid();
        if(!$UserId){
            throw new TokenException();
        }
        (new IDMustNumeric())->goCheck();
        $giftId = $id;
        $gift = GiftModel::getGiftById($giftId);
        //判断当前id是否和gift中的
        if(GiftModel::isYourselfGift($UserId,$gift->uid)){
            throw  new IsYourselfGiftException();
        }
        $can = UserModel::canSendDrift($UserId);
        $user = UserModel::getUserById($UserId);
        if(!$can){
            throw new BeansNotEnoughException([
                'msg'=> 'Your Beans is not Enough, Your Beans is '.$user->beans
            ]);
        }
        $user = $user->toArray();
        return UserModel::Summary($user);
    }
}