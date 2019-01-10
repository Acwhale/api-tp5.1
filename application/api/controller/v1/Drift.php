<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2019/1/3
 * Time: 13:51
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\HttpHelper;
use app\api\service\Token as TokenService;
use app\libs\Exception\BeansNotEnoughException;
use app\libs\Exception\Failed;
use app\libs\Exception\IsYourselfGiftException;
use app\libs\Exception\Success;
use app\libs\Exception\TokenException;
use app\libs\utils\Email;
use app\validate\DriftInfoValidate;
use app\validate\IDMustNumeric;
use app\api\model\Gift as GiftModel;
use app\api\model\User as UserModel;
use app\api\model\Drift as DriftModel;
use app\api\viewModel\Book as BookView;
use app\api\viewModel\Drift as DriftView;
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

    /**
     * 添加邮寄信息
     */
    public function setInfo(){
        $userId = TokenService::getCurrentUid();
        if(!$userId){
            throw new TokenException();
        }
        (new DriftInfoValidate())->goCheck();
        $info = input('post.');
        return $this->saveInfo($info,$userId);
    }

    private function saveInfo($info,$userID){
        $gift = GiftModel::getGiftAndUserById($info['gid']);
        $user = UserModel::getUserById($userID);
        $drift = new DriftModel();
        $drift->recipient_name = $info['recipientName'];
        $drift->mobile = $info['mobile'];
        $drift->message = $info['message'];
        $drift->address = $info['address'];
        $drift->gift_id = $gift->id;
        $drift->requester_id = $userID;
        $drift->requester_nickname = $user->nickname;
        $drift->gifter_nickname = $gift->user->nickname;
        $drift->gifter_id = $gift->user->id;

        $book = (new HttpHelper())->get($gift->isbn,1);
        $book = BookView::packageSingle($book);
        $drift->book_title = $book['books'][0]['title'];
        $drift->book_author =  $book['books'][0]['author'];
        $drift->book_img =  $book['books'][0]['image'];
        $drift->isbn =  $book['books'][0]['isbn'];

        if($drift->save()){
            $user->beans -= 1;
            if($user->save()){
               if((new Email())->sendDriftEmail($gift->user->email,$gift->user->nickname,$book['books'][0]['title'])){
                   return json(new Success([
                       'msg' => '想书籍赠送者发送请求成功'
                   ]));
               }
            }
            return json(new Failed());
        }
    }
    public function pending(){
        $userId = TokenService::getCurrentUid();
        if(!$userId){
            throw  new TokenException();
        }
        $drifts  = DriftModel::allDrift($userId)->toArray();
        return  DriftView::isSingleOrCollection($drifts,$userId);
    }
}