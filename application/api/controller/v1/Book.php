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
use app\api\viewModel\Book as BookViewModel;
use app\libs\Exception\IsbnException;
use app\validate\SearchValidate;

class Book extends BaseController {
    /**
     * @return array
     * @throws \app\libs\Exception\NotFoundException
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

    /**
     * @param string $isbn
     * @return array
     * @throws IsbnException
     * @throws \app\libs\Exception\NotFoundException
     * 书籍详情
     */
    public function bookDetail ($isbn = '') {
        $result = isIsbnOrKey($isbn);
        if ($result != "isbn") {
            throw new IsbnException();
        }
        $book = (new HttpHelper())->get($isbn,$page = 1);
        return BookViewModel::packageSingle($book);
    }
}

