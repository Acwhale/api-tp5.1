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
use app\api\model\Gift as GiftModel;
use function PHPSTORM_META\type;

class Gift extends BaseController {
    /**
     * 加入心愿清单
     * @return array|\PDOStatement|string|\think\Model|null
     * @throws IsbnException
     * @throws \app\libs\Exception\GiftOrWishException
     * @throws \app\libs\Exception\NotFoundException
     * @throws \app\libs\Exception\ParameterException
     * @throws \think\Exception
     */
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

    public function givers($isbn =''){
        if(isIsbnOrKey($isbn) != 'isbn'){
            throw new IsbnException();
        }
        #TODO
//        $hasInGift = false;

        $givers = GiftModel::getAllGivers($isbn);
        $givers->visible(['user.id','create_time','isbn','user.nickname']);
//        if(GiftModel::hasInGift($isbn)){
//            $givers->unshift(!$hasInGift,'hasInGift');
//        }
        return $givers;
    }
}