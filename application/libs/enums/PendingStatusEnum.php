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
}