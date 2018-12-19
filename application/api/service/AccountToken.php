<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 11:42
 */

namespace app\api\service;


use app\api\model\User;
use app\libs\enums\ClientTypeEnum;
use app\libs\Exception\TokenException;
use think\facade\Config;
use think\facade\Cache;

class AccountToken extends Token {
    protected $id;
    protected $type;
    public function __construct($id,$type=ClientTypeEnum::USER_EMAIL) {
        $this->id = $id;
        $this->type= $type;
    }

    public function get(){
        $token =  self::grantToken($this->id,$this->type);
        return $token;
    }

    private static function grantToken($id,$type)
    {
        $cache = [
            'uid' => $id,
            'type' => $type,
            'scope' => null
        ];
        $expire_in = Config::get('secure.token_exprie_in');
        $cache['expire_in'] = $expire_in;
        $key = self::generateToken();
        $value = json_encode($cache);
        $result = Cache::set($key, $value,$expire_in );
        if (!$result) {
            throw  new TokenException([
                'msg' => '服务器缓存异常',
                'errCode' => 10005
            ]);
        }
        return $key;
    }
}