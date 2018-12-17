<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 11:28
 */

namespace app\api\controller\v1;



use app\api\controller\BaseController;
use app\api\model\User ;
use app\libs\enums\ClientTypeEnum;
use app\libs\Exception\Failed;
use app\libs\Exception\RegisterTypeNotDefine;
use app\libs\Exception\Success;
use app\validate\UserEmailForm;
use think\facade\Config;

class Client extends BaseController {
    public function createClient() {
        (new UserEmailForm())->goCheck();
        $dataArr = input('post.');
        switch ($dataArr['type']) {
            case ClientTypeEnum::USER_EMAIL:
                return $this->registerByEmail($dataArr);
                break;
            default:
                throw  new RegisterTypeNotDefine();
                break;
        }
    }

    public function registerByEmail($dataArr) {
        if (!is_array($dataArr)) {
            return;
        }
        $result = User::where('email', '=', $dataArr['account'])->find();
        if (empty($result)) {
            $salt = Config::get('secure.salt');
            $password = md5( $dataArr['secret'].$salt);
            $data = [
                'email' => $dataArr['account'],
                'password' => $password,
                'nickname' => $dataArr['nickname']
            ];
            $user = new User();
            $user->save($data);
            return json(new Success(),201);
        } else {
            return json(new Failed(),409);
        }

    }
}