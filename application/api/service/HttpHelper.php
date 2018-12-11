<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/10
 * Time: 18:03
 */

namespace app\api\service;


class HttpHelper {
    /**
     * @param $q
     * @param $page
     * @return mixed
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
        if (empty($result)) {
            return [];
        }
        return $result;
    }

    /**
     * @param $prePage
     * @param $page
     * @return float|in
     * 根据page返回start
     */
    protected function start ($prePage,$page) {
        return ($page-1)*$prePage;
    }
}