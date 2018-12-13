<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/10
 * Time: 18:03
 */

namespace app\api\service;


use app\libs\Exception\NotFoundException;

class HttpHelper {
    /**
     * @param $q
     * @param $page
     * @return mixed
     * @throws NotFoundException
     * 书籍检索
     */

    public function get($q,$page){
        $prePage = config('base.prePage');
        $keyOrIsbn = isIsbnOrKey($q);
        if ($keyOrIsbn == 'key'){
            if ($page == null) {
                $page = 1;
            }
            $baseUrl = sprintf(config('base.keyword_url'), $q, $prePage, $this->start($prePage,$page));
        }else{
            $baseUrl = sprintf(config('base.isbn_url'),$q);
        }
        $result = curl_get($baseUrl);
        if (array_key_exists('msg',$result) && $result['msg'] == 'book not found') {
                throw new NotFoundException();
        } elseif ($result['total'] == 0) {
             throw new NotFoundException();
        }
        $result['keyword'] = $q;
        return $result;
    }

    /**
     * @param $prePage
     * @param $page
     * @return float|in
     * 根据page返回start
     */
    protected function start ($prePage,$page) {
        return ($page-1) * $prePage;
    }
}