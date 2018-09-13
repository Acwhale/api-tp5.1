<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/9/13
 * Time: 10:29
 */

namespace app\api\controller\v1;


use app\api\BaseController;

class Book extends BaseController {
    public function getBook(){
        return "book";
    }
}