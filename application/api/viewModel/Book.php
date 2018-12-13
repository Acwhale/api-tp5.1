<?php
/**
 * Created by PhpStorm.
 * User: hello
 * Date: 2018/12/12
 * Time: 11:47
 */

namespace app\api\viewModel;


class Book {

    /**
     * @param $data
     * @return array
     * 判读是单数据还是多数据
     */
    public static function isSingleOrCollection ($data) {
        if (array_key_exists('books',$data)) {
            return self::packageCollection($data);
        } else {
            return self::packageSingle($data);
        }
    }

    /**
     * @param $data
     * @return array
     * 处理一种数据
     */
    public static function packageSingle ($data) {
        $returned = [];
        if ($data) {
            $returned['keyword'] = $data['keyword'];
            $returned['total'] = 1;
            $returned['books'] = [self::cutBookData($data)];
        }
        return $returned;
    }

    /**
     * @param $data
     * @return array
     * 多种数据处理
     */
    public static function packageCollection ($data) {
        $returned = [];
        if ($data) {
            $returned['count'] = $data['count'];
            $returned['keyword'] = $data['keyword'] ;
            $returned['total'] = $data['total'];
            foreach ($data['books'] as $value) {
//                return (self::cutBookData($value));
                $returned['books'][] = self::cutBookData($value);
            }
        }
        return $returned;
    }

    /**
     * @param $data
     * @return array
     * 裁剪数据
     */
    public static function cutBookData ($data) {
        $book = [];
        $book['isbn'] = $data['isbn'];
        $book['title'] = $data['title'];
        $book['publisher'] = $data['publisher'];
        $book['pages'] = empty($data['pages']) ? '' : $data['pages'];
        $book['author'] = join('、',$data['author']);
        $book['summary'] = empty($data['summary']) ? '' : $data['summary'];
        $book['image'] = $data['image'];
        $book['pubdate'] = $data['pubdate'];
        $book['price'] = $data['price'];
        $book['binding'] = empty($data['binding']) ? '' : $data['binding'];
        return $book;
    }


}