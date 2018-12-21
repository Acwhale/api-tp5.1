<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 13:58
 */

namespace app\api\model;


use app\libs\Exception\AuthFailedException;
use app\libs\Exception\NotFoundException;
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


}