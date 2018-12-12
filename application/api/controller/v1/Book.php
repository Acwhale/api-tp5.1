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
use app\api\viewModel\BookViewModel;
use app\validate\SearchValidate;

class Book extends BaseController {
    /**
     * @return mixed
     * @throws \app\libs\Exception\ParameterException
     * 书籍检索
     */
    public function search(){
        (new SearchValidate())->goCheck();
        $q = input('get.q');
        $page = input('get.page');
        $result =  (new HttpHelper())->get($q,$page);
        return BookViewModel::isSingleOrCollection($result);
    }
}

