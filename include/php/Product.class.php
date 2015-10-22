<?php
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();

    class Product {
        public $id;
        public $catid;
        public $name;
        public $price;
        public $instock;
        public $description;
        public $timestamp;

        public function __construct($id) {
            $result = $GLOBALS['db']->query('SELECT * FROM products WHERE id="' . $id . '"');
            $this->id = $result[0]['id'];
            $this->catid = $result[0]['catid'];
            $this->name = $result[0]['name'];
            $this->price = $result[0]['price'];
            $this->instock = $result[0]['instock'];
            $this->description = $result[0]['description'];
            $this->timestamp = $result[0]['timestamp'];
        }

        public function getImg() {
            if(file_exists(dirname(__FILE__) . '/../../img/products/' . $this->id . 'p1.jpeg')) {
                return 'img/products/' . $this->id . 'p1.jpeg';
            }

            return false;
        }

        public function getAllImgs() {
            $i = 1;
            $imgs = array();
            while($i < 4) {
                if(file_exists(dirname(__FILE__) . '/../../img/products/' . $this->id . 'p' . $i . '.jpeg')) {
                    $imgs[] = 'img/products/' . $this->id . 'p' . $i . '.jpeg';
                }
                $i++;
            }

            return $imgs;
        }

        public function getAvgRating() {
            $GLOBALS['db']->bind("id", $this->id);
            $result = $GLOBALS['db']->query('SELECT ROUND(AVG(r.rating), 1) rating FROM products p INNER JOIN review r ON p.id=r.productid WHERE p.id=:id');
            return $result[0]['rating'];
        }

        public function getAllReviews() {
            $GLOBALS['db']->bind("id", $this->id);
            $result = $GLOBALS['db']->query('SELECT r.*, u.* FROM products p INNER JOIN review r ON p.id=r.productid INNER JOIN users u ON u.id=r.userid WHERE p.id=:id');
            return $result;
        }

        public static function getAllProducts($catid = null, $q = null, $p = null,  $rt = 1, $ra = null, $os = null) {
            $products = array();

            if($catid == null) {
                $results = $GLOBALS['db']->query("SELECT c.id catid, c.name catname, p.* FROM products p INNER JOIN categories c ON c.id=p.catid");

                foreach($results as $result) {
                    $products[$result['catid']]['catname'] = $result['catname'];
                    $products[$result['catid']]['catid'] = $result['catid'];
                    $products[$result['catid']][] = array(
                        'id' => $result['id'],
                        'name' => $result['name'],
                        'price' => $result['price'],
                        'instock' => $result['instock'],
                        'description' => $result['description'],
                        'timestamp' => $result['timestamp']
                    );
                }
            } else {
                $where = array();
                $where['catid'] = '(p.catid=' . implode(' OR p.catid=', explode('|', $catid)) . ')';
                isset($q) ? $where['q'] = '(p.name LIKE "%' . $q . '%")' : null;
                isset($os) ? ($os=="1" ? null : ($where['os'] = '(instock=1)')) : ($where['os'] = '(instock=1)');
                $whereStr = implode(' AND ', $where);
                $order = array();
                isset($p) ? ($p==1 ? ($order['p'] = 'p.price DESC') : ($order['p'] = 'p.price ASC')) : null;
                isset($rt) ? ($rt==1 ? ($order['rt'] = 'rating DESC') : ($order['rt'] = 'rating ASC')) : null;
                isset($ra) ? ($ra==1 ? ($order['ra'] = 'p.timestamp DESC') : ($order['ra'] = 'p.timestamp ASC')) : null;
                $orderStr = implode(', ', $order);

                $query = 'SELECT c.id catid, c.name catname, p.*, AVG(r.rating) rating FROM products p INNER JOIN categories c ON c.id=p.catid LEFT JOIN review r ON r.productid=p.id WHERE ' . $whereStr . ' GROUP BY p.id ' . ($orderStr!='' ? ('ORDER BY ' . $orderStr) : ';');
                $results = $GLOBALS['db']->query($query);

                $count = 0;
                if($results != null) {
                    foreach($results as $result) {
                        if(!strpos($catid, '|')) {
                            $products['catname'] = $result['catname'];
                            $products['catid'] = $result['catid'];
                        }
                        $products[] = array(
                            'id' => $result['id'],
                            'name' => $result['name'],
                            'price' => $result['price'],
                            'instock' => $result['instock'],
                            'description' => $result['description'],
                            'timestamp' => $result['timestamp']
                        );
                        $count++;
                    }
                    $products['count'] = $count;
                }
            }

            return $products;
        }
    }