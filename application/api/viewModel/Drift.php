<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2019/1/5
 * Time: 10:34
 */

namespace app\api\viewModel;


use app\libs\enums\PendingStatusEnum;
use app\libs\Exception\NotFoundException;

class Drift {
    /**
     * 判读是单个还是多个
     * @param $drifts
     * @param $userId
     * @return array
     * @throws NotFoundException
     */
    public static function isSingleOrCollection($drifts,$userId){
        if(count($drifts) == 17){
            return self::single($drifts,$userId);
        }else if(count($drifts) == 0){
            throw  new NotFoundException([
                'msg'=>'暂无数据显示'
            ]);
        }else{
            return self::collection($drifts,$userId);
        }
    }

    /**
     * 结果是单个
     * @param $drifts
     * @param $userId
     * @return array
     */
    private static function single($drifts,$userId){
        $returned[] = self::cutData($drifts,$userId);
        return $returned;
    }

    /**
     * 结果是多个
     * @param $drifts
     * @param $userId
     * @return array
     */
    private static function  collection($drifts,$userId){
        $returned = [];
        foreach ($drifts as $value) {
            $returned[] = self::cutData($value,$userId);
        }
        return $returned;
    }

    /**
     * 裁剪数据
     * @param $drifts
     * @param $userId
     * @return array
     */
    private static function cutData($drifts,$userId){
        $drift = [];
        $you_are = self::isRequesterOrGifter($drifts['requester_id'],$userId);
        $drift['drift_id'] = $drifts['id'];
        $drift['book_title'] = $drifts['book_title'];
        $drift['book_author'] = $drifts['book_author'];
        $drift['book_img'] = $drifts['book_img'];
        $drift['date'] = $drifts['create_time'];
        $drift['message'] = $drifts['message'];
        $drift['address'] = $drifts['address'];
        $drift['recipient_name'] = $drifts['recipient_name'];
        $drift['mobile'] = $drifts['mobile'];
        $drift['status_desc'] = PendingStatusEnum::pendingStatus($drifts['pending'],$you_are);
        $drift['status'] = $drifts['pending'];
        $drift['you_are'] = $you_are;
        $drift['operator'] = self::operator($you_are,$drifts);
        return $drift;
    }

    /**
     * 返回名字
     * @param $you_are
     * @param $drift
     * @return mixed
     */
    private static function operator($you_are,$drift){
        return $you_are == 'requester' ? $drift['requester_nickname'] : $drift['gifter_nickname'];
    }
    /**
     * 请求者还是赠送者
     * @param $requester_id
     * @param $userId
     * @return string
     */
    private static function isRequesterOrGifter($requester_id,$userId){
        return $requester_id == $userId ? 'requester' : 'gifter' ;
     }

}