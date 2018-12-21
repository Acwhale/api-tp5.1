<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/21
 * Time: 15:04
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\libs\Exception\IsbnException;
use app\validate\IDMustNumeric;
use app\api\service\Wish as WishService;
use app\api\model\Wish as WishModel;
class Wish extends BaseController {
    public function saveToWish(){
        $post = input('post.');
        $isbn = $post['isbn'];
        $id = $post['id'];
        if(isIsbnOrKey($isbn) != 'isbn'){
            throw  new IsbnException();
        }
        (new IDMustNumeric())->goCheck();
        return WishService::saveToWish($isbn,$id);
    }
    public function wishers($isbn=''){
        if(isIsbnOrKey($isbn) != 'isbn'){
            throw new IsbnException();
        }
        $wishers =  WishModel::getAllWishers($isbn);
        $wishers->visible(['user.id','create_time','isbn','user.nickname']);
        return $wishers;
    }
}