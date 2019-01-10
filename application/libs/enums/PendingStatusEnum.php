<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2019/1/3
 * Time: 13:48
 */

namespace app\libs\enums;


class PendingStatusEnum {
    #交易状态
    const  Waiting = 1;
    const  Success = 2;
    const  Reject = 3;
    const  Redraw = 4;



    public static function pendingStatus($status,$key){
        $keyMap = [
            1=> [
                'requester' => '等待对方邮寄',
                'gifter'=> '等待你邮寄'
            ],

            3 =>[
                'requester' =>  '对方已拒绝',
                'gifter'=> '你已拒绝'
            ],


            4 => [
                'requester'=> '你已撤销',
                'gifter'=> '对方已撤销'
            ],

            2 =>[
                'requester'=>'对方已邮寄',
                'gifter'=> '你已邮寄，交易完成'
            ]
        ];
        return $keyMap[$status][$key];
    }
}