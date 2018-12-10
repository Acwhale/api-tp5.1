<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/10
 * Time: 18:03
 */

namespace app\api\service;

class HttpHelper {
    protected $start = 1;
    protected $count = 20;
    public function get($q){
        $keyOrIsbn = isIsbnOrKey($q);
        if ($keyOrIsbn == 'key'){
            $baseUrl = sprintf(config('base.keyword_url'),$q,$this->count,$this->start);
        }else{
            $baseUrl = sprintf(config('base.isbn_url'),$q);
        }
        $result = curl_get($baseUrl);
        return $result;


    }
}