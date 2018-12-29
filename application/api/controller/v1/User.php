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
use app\libs\enums\ClientTypeEnum;
use app\libs\enums\UserStatusEnum;
use app\libs\Exception\Failed;
use app\libs\Exception\NotFoundException;
use app\libs\Exception\ParameterException;
use app\libs\Exception\Success;
use app\libs\Exception\TokenException;
use app\libs\utils\Email;
use app\validate\EmailValidate;
use app\validate\IDMustNumeric;
use app\api\model\User as UserModel;
use app\validate\LoginByEmailValidate;
use app\api\service\AccountToken as AtService;
use app\api\service\Token as TokenService;
class User extends BaseController {
//    protected $beforeActionList = [
//        'checkLogin'=>[
//            'only'=>'getUser'
//        ]
//    ];

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

    /**
     * 登录
     * @return array
     * @throws NotFoundException
     * @throws ParameterException
     */
    public function login () {
        (new LoginByEmailValidate())->goCheck();
        $data = input('post.');
        if(!is_array($data)){
            throw new ParameterException();
        }
        switch ($data['type']){
            case ClientTypeEnum::USER_EMAIL:
                return $this->loginByEmail($data);
                break;
        }
    }

    private function loginByEmail($data)
    {
        $user = UserModel::where('email', '=', $data['account'])->
        where('status', '=', UserStatusEnum::ACTIVE)->find();
        $salt = config('secure.salt');
        if ($user->password == md5($data['secret'] . $salt)) {
            $at = new AtService($user->id);
            $token = $at->get();
            return [
                'token' => $token
            ];
        }else{
            throw new NotFoundException();
        }
    }

    /**
     * 颁发token
     * @return array
     */
    public function getToken(){
        $id =  TokenService::getCurrentUid();
        return [
            'id' => $id
        ];
    }

    /**
     * 注销登陆
     * @return \think\response\Json
     * @throws \app\libs\Exception\TokenException
     */
    public function logout(){
        return TokenService::clearCache();
    }

    public function info(){
        echo phpinfo();
    }
    public function resetPassword(){
        $id = TokenService::getCurrentTokenVar('uid');
        if(!$id){
            throw  new TokenException();
        }
        $user = UserModel::getUserById($id);
        if(empty($user)){
            throw new NotFoundException();
        }
        (new EmailValidate())->goCheck();
        $email = input('post.');
        if($user->email == $email['email']){
            $name = $user->nickname;
            $salt = config('secure.salt');
            $newPassword = getRandChar(6);
            $user->password = (md5($newPassword.$salt));
            $user->force()->save();
            if((new Email())->send($email['email'],$name,$newPassword)){
                return json(new Success([
                    'code' =>200,
                    'msg' => '请在邮件中查询你的新密码'
                ]));
            }
            return json(new Failed([
                'code'=>200,
                'msg'=>'请稍后重试',
                'errCode'=>10009
            ]));
        }
    }
}

