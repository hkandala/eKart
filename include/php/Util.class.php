<?php
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();

    class Util {

        public static function getImg($pid) {
            if(file_exists(dirname(__FILE__) . '/../../img/products/' . $pid . 'p1.jpeg')) {
                return 'img/products/' . $pid . 'p1.jpeg';
            }

            return false;
        }

        public static function getAllImgs($pid) {
            $i = 1;
            $imgs = array();
            while($i < 4) {
                if(file_exists(dirname(__FILE__) . '/../../img/products/' . $pid . 'p' . $i . '.jpeg')) {
                    $imgs[] = 'img/products/' . $pid . 'p' . $i . '.jpeg';
                }
                $i++;
            }

            return $imgs;
        }
    }