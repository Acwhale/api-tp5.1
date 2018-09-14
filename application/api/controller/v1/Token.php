<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 10:30
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\validate\UserTokenValidate;
use app\api\service\AccountToken as AtService;

class Token extends BaseController {
    /**
     * 通过account secret获取token
     */
    public function getAccountToken(){

        (new  UserTokenValidate())->goCheck();
        $dataArr = input('post.');
        $id = UserModel::getUserByEmail($dataArr);
        $at = new AtService($id);
        $token = $at->get();
        return [
            'token'=>$token
        ];
    }

}