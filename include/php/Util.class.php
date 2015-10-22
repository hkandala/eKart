<?php
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();

    class Util {

        public static function getAllCategories() {
            $results = $GLOBALS['db']->query('SELECT * FROM categories');
            return $results;
        }

        public static function getCategoryStr() {
            $results = Util::getAllCategories();
            $cat = array();
            foreach($results as $result) {
                $cat[] = $result['id'];
            }
            $catStr = implode('|', $cat);
            return $catStr;
        }

        public static function isCategoryChecked($id) {
            $allCheckedCat = explode("|", isset($_REQUEST['catid']) ? $_REQUEST['catid'] : null);
            foreach($allCheckedCat as $cat) {
                if($cat == $id) {
                    return true;
                }
            }

            return false;
        }
    }