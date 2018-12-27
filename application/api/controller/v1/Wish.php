<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/21
 * Time: 15:04
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\HttpHelper;
use app\libs\Exception\IsbnException;
use app\validate\IDMustNumeric;
use app\api\service\Wish as WishService;
use app\api\viewModel\Book as BookViewmodel;
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

    public function wishes($id = ''){
        (new IDMustNumeric())->goCheck();
        $myWishes =  WishModel::myWishes($id);
        $helper = new HttpHelper();
        $isbnList = [];
        foreach($myWishes as $wish){
            array_push($isbnList,$wish['isbn']);
        }
        $countList =  WishModel::getGiftsCount($isbnList);
        $book = [];
        foreach ($countList as $list){
            $result = BookViewModel::packageSingle($helper->get($list['isbn'],''));
            $result['gifts'] = $list['giftCount'];
            $book[] = $result;
        }
        return $book;
    }
}