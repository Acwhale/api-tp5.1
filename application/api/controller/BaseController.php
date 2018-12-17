<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 10:30
 */

namespace app\api\controller;


use think\Controller;
use app\api\service\Token as TokenService;
class BaseController extends Controller {
    protected function  checkLogin(){
        TokenService::userIsLogin();
    }
}