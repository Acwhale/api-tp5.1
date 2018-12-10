<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 10:29
 */

namespace app\api\controller\v1;



use app\api\controller\BaseController;
use app\api\service\HttpHelper;
use app\validate\PageValidate;
use think\facade\Config;

class Book extends BaseController {
    //http://t.yushu.im/v2/book/search?q=%E6%9D%91%E4%B8%8A
    public function search(){
        (new PageValidate())->goCheck();
        $q = input('get.q');
        $page = input('get.page');
        return (new HttpHelper())->get($q);
        return 1;
    }
}

