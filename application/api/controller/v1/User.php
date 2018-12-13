<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 15:58
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\AccountToken;
use app\libs\enums\UserStatusEnum;
use app\libs\Exception\NotFoundException;
use app\libs\Exception\Success;
use app\validate\IDMustNumeric;
use app\api\model\User as UserModel;

class User extends BaseController {
    /**
     * @param string $id
     * @return array|null|\PDOStatement|string|\think\Model
     * @throws NotFoundException
     * @throws \app\libs\Exception\ParameterException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUser($id=''){
        (new IDMustNumeric())->goCheck();
        $user = UserModel::where('id','=',$id)->find();
        if(empty($user)){
            throw new NotFoundException([
                'msg'=>'user not found'
            ]);
        }
        return $user;
    }

    /**
     * 删除用户
     * @return \think\response\Json
     * @throws NotFoundException
     * @throws \think\Exception\DbException
     */
    public function deleteUser(){
        $id = AccountToken::getCurrentUid();
        $user = UserModel::get(['id'=>$id,'status'=>UserStatusEnum::ACTIVE]);
        if(empty($user)){
            throw new NotFoundException([
                'msg'=>'user not found'
            ]);
        }
        $user->status = UserStatusEnum::NOT_ACTIVE;
        $user->save();
        return json(new Success([
            'code'=>202,
            'errCode'=>-1
        ]),202);
//        return 1;
    }

    public function login () {

    }
}