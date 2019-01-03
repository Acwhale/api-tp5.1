<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 13:58
 */

namespace app\api\model;


use app\libs\enums\PendingStatusEnum;
use app\libs\enums\UserStatusEnum;
use app\libs\Exception\AuthFailedException;
use app\libs\Exception\NotFoundException;
use think\Db;
use think\facade\Config;

class User extends BaseModel {

    protected $hidden = ['create_time','update_time'];

    public static function getUserByEmail($dataArr) {
        if (!is_array($dataArr)) {
            return;
        }
        $user = self::where('email', '=', $dataArr['account'])->find();
        if (empty($user)) {
            throw new NotFoundException([
                'msg' => 'user not found'
            ]);

        } else {
            $salt = Config::get('secure.salt');
            $secret =(md5(  $dataArr['secret'].$salt ));
            if ($secret!= $user->password) {
                throw new AuthFailedException();
            }else{
                return $user->id;
            }
        }
    }
    public static function getUserById($id){
        return self::where('id','=',$id)->find();
    }

    public static function canSendDrift($id){
        $user = self::where('id','=',$id)->where('status','=',UserStatusEnum::ACTIVE)->find();
        if(!$user){
            throw  new NotFoundException();
        }
        if($user->beans < 1){
            return false;
        }
        $successGiftCount = self::successGiftCount($id);
        $successReceiveCount = self::successReceiveCount($id);
        return floor($successReceiveCount[0]['successReceiveCount'] / 2 ) <=  $successGiftCount[0]['successGiftCount'] ? true : false;
    }

    private static function successGiftCount($id){
        return Db::table('gift')->field('count("isbn") AS successGiftCount')->where('uid','=',$id)
            ->where('launched','=',1)->select();
    }
    private static function successReceiveCount($id){
       return  Db::table('drift')->field('count("requester_id") AS successReceiveCount')
            ->where('requester_id','=',$id)
            ->where('pending','=',PendingStatusEnum::Success)->select();
    }
    public static function Summary($user){
        return [
            'nickname' => $user['nickname'],
            'beans' => $user['beans'],
            'email'=> $user['email'],
            'send_receive' => $user['send_conuter'] . '/' .$user['receive_counter']
        ];
    }
}