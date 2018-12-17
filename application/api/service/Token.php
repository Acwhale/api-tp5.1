<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/14
 * Time: 11:42
 */

namespace app\api\service;


use app\libs\Exception\ForbiddenException;
use app\libs\Exception\TokenException;
use think\facade\Cache;
use think\facade\Config;
use think\facade\Request;

class Token {
    public static function generateToken(){
        /**
         * @return string
         * 生成token
         */
        $salt = Config::get('secure.salt');
        $time = $_SERVER['REQUEST_TIME'];
        $randChar = getRandChar(32);
        return md5($salt.$time.$randChar);
    }

    public static function getCurrentTokenVar($key){
        $token = Request::header('token');
        $vars = Cache::get($token);
        if(!$vars){
            throw  new TokenException();
        }else{
            if(!is_array($vars)){
                $vars = json_decode($vars,true);
                if(array_key_exists($key,$vars)){
                    return $vars[$key];
                }else{
                    throw new Exception('尝试获取的Token并不存在');
                }
            }
        }
    }

    /**
     * 获取当前用户
     */
    public static function getCurrentUid(){
        return self::getCurrentTokenVar('uid');
    }
    /**
     * 获取当前用户类型
     */
    public static function getCurrentType(){
        return self::getCurrentTokenVar('type');
    }

    /**
     * 获取当前用户的权限
     */
    public static function getCurrentScope(){
        return self::getCurrentTokenVar('scope');
    }
    /**
     * 用户是否登录
     */
    public static function userIsLogin(){
        $id = self::getCurrentTokenVar('id');
        if($id){
            return true;
        }else{
            throw new ForbiddenException();
        }
    }

}