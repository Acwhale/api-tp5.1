<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/19
 * Time: 15:55
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\libs\Exception\IsbnException;
use app\validate\IDMustNumeric;
use app\api\service\Gift as GiftService;
class Gift extends BaseController {
    public function saveToGift(){
        $post = input('post.');
        $isbn = $post['isbn'];
        $id = $post['id'];
        if(isIsbnOrKey($isbn) != 'isbn'){
            throw new IsbnException([
                'msg' => 'isbn is incorrect '
            ]);
        }
        (new IDMustNumeric())->goCheck();
        return GiftService::saveToGift($isbn,$id);
    }
}