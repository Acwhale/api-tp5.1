<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 11:28
 */

namespace app\api\controller\v1;


use app\api\BaseController;
use app\api\model\User;
use app\libs\enums\ClientTypeEnum;
use app\libs\Exception\RegisterTypeNotDefine;
use app\validate\UserEmailForm;

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
            $data = [
                'email' => $dataArr['account'],
                'password' => md5(getRandChar(32) . $_SERVER['REQUEST_TIME'] . config('secure.salt')),
                'nickname' => $dataArr['nickname']
            ];
            $user = new User();
            $user->save($data);
            return json('success',200);
        } else {
            return json('fail');
        }

    }
}