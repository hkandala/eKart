<?php
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();

    class User {
        public $id;
        public $fname;
        public $lname;
        public $email;
        public $password;
        public $mobile;
        public $dob;

        public function __construct($id = null) {
            if($id != null) {
                $this->loadUser($id);
            }
        }

        public function newUser($fname, $lname, $email, $password, $mobile=null, $dob=null) {
            $check = $GLOBALS['db']->query('SELECT * FROM users WHERE email="' . $email . '"');
            if($check == null) {
                $GLOBALS['db']->bindMore(array(
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'password' => $password,
                    'mobile' => $mobile,
                    'dob' => $dob
                ));
                $result = $GLOBALS['db']->query('INSERT INTO users(fname, lname, email, password, mobile, dob) VALUES(:fname, :lname, :email, :password, :mobile, :dob)');
                if($result > 0) {
                    $result2 = $GLOBALS['db']->query('SELECT * FROM users WHERE email="' . $email . '"');
                    $this->id = $result2[0]['id'];
                    $this->fname = $result2[0]['fname'];
                    $this->lname = $result2[0]['lname'];
                    $this->email = $result2[0]['email'];
                    $this->password = $result2[0]['password'];
                    $this->mobile = $result2[0]['mobile'];
                    $this->dob = $result2[0]['dob'];

                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function loadUser($id) {
            $result = $GLOBALS['db']->query('SELECT * FROM users WHERE id="' . $id . '"');
            if($result != null) {
                $this->id = $result[0]['id'];
                $this->fname = $result[0]['fname'];
                $this->lname = $result[0]['lname'];
                $this->email = $result[0]['email'];
                $this->password = $result[0]['password'];
                $this->mobile = $result[0]['mobile'];
                $this->dob = $result[0]['dob'];

                return true;
            } else {
                return false;
            }
        }

        public function loadUserFromEmail($email) {
            $result = $GLOBALS['db']->query('SELECT * FROM users WHERE email="' . $email . '"');
            if($result != null) {
                $this->id = $result[0]['id'];
                $this->fname = $result[0]['fname'];
                $this->lname = $result[0]['lname'];
                $this->email = $result[0]['email'];
                $this->password = $result[0]['password'];
                $this->mobile = $result[0]['mobile'];
                $this->dob = $result[0]['dob'];

                return true;
            } else {
                return false;
            }
        }

        public function updateUser($fname=null, $lname=null, $password, $mobile=null, $dob=null) {
            $GLOBALS['db']->bindMore(array(
                'fname' => $fname,
                'lname' => $lname,
                'password' => $password,
                'mobile' => $mobile,
                'dob' => $dob
            ));
            if($fname!=null || $lname!=null || $password!=null || $mobile!=null || $dob!=null) {
                $q = array();
                if($fname!=null) {
                    $q[] = 'fname="' . $fname . '"';
                }
                if($lname!=null) {
                    $q[] = 'lname="' . $lname . '"';
                }
                if($password!=null) {
                    $q[] = 'password="' . $password . '"';
                }
                if($mobile!=null) {
                    $q[] = 'mobile="' . $mobile . '"';
                }
                if($dob!=null) {
                    $q[] = 'dob="' . $dob . '"';
                }
                $sQuery = implode(', ', $q);
                $query = 'UPDATE users SET ' . $sQuery . ' WHERE id="' . $this->id . '"';
                $result = $GLOBALS['db']->query($query);
                if($result > 0) {
                    $fname!=null ? $this->fname = $fname : null;
                    $lname!=null ? $this->lname = $lname : null;
                    $password!=null ? $this->password = $password : null;
                    $mobile!=null ? $this->mobile = $mobile : null;
                    $dob!=null ? $this->dob = $dob : null;
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }

        public function loadCart() {
            if($this->id!=null) {
                $result = $GLOBALS['db']->query('SELECT * FROM cart uc INNER JOIN products p ON uc.productid=p.id WHERE userid="' . $this->id . '"');
                return $result;
            } else {
                return false;
            }
        }

        public function totalCartPrice() {
            if($this->id!=null) {
                $cart = $this->loadCart();
                $total = 0;
                foreach ($cart as $cartItem) {
                    $total = $total + $cartItem['price'] * $cartItem['qty'];
                }

                return $total;
            } else {
                return false;
            }
        }

        public function loadReview($id) {
            if($this->id!=null) {
                $GLOBALS['db']->bindMore(array(
                    'userid'    => $this->id,
                    'productid' => $id,
                ));
                $result = $GLOBALS['db']->query('SELECT * FROM review WHERE userid=:userid AND productid=:productid');
                if (count($result) != 0) {
                    return $result[0];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function addReview($id, $rating, $comment) {
            if($this->id!=null) {
                $GLOBALS['db']->bindMore(array(
                    'userid'    => $this->id,
                    'productid' => $id,
                ));
                $check = $GLOBALS['db']->query('SELECT id FROM review WHERE userid=:userid AND productid=:productid');
                if (count($check) == 0) {
                    $GLOBALS['db']->bindMore(array(
                        'userid'    => $this->id,
                        'productid' => $id,
                        'rating'    => $rating,
                        'comment'   => $comment
                    ));
                    $result = $GLOBALS['db']->query('INSERT INTO review(userid, productid, rating, comment) VALUES(:userid, :productid, :rating, :comment)');
                    if ($result > 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function editReview($id, $rating, $comment) {
            if($this->id!=null) {
                $GLOBALS['db']->bindMore(array(
                    'userid'    => $this->id,
                    'productid' => $id,
                ));
                $check = $GLOBALS['db']->query('SELECT id FROM review WHERE userid=:userid AND productid=:productid');
                if (count($check) != 0) {
                    $GLOBALS['db']->bindMore(array(
                        'userid'    => $this->id,
                        'productid' => $id,
                        'rating'    => $rating,
                        'comment'   => $comment
                    ));
                    $result = $GLOBALS['db']->query('UPDATE review SET rating=:rating, comment=:comment WHERE userid=:userid AND productid=:productid');
                    if ($result > 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function deleteReview($id) {
            if($this->id!=null) {
                $GLOBALS['db']->bindMore(array(
                    'userid'    => $this->id,
                    'productid' => $id,
                ));
                $check = $GLOBALS['db']->query('SELECT id FROM review WHERE userid=:userid AND productid=:productid');
                if (count($check) != 0) {
                    $GLOBALS['db']->bindMore(array(
                        'userid'    => $this->id,
                        'productid' => $id,
                    ));
                    $result = $GLOBALS['db']->query('DELETE FROM review WHERE userid=:userid AND productid=:productid');
                    if ($result > 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function addToCart($id) {
            if($this->id != null) {
                $GLOBALS['db']->bindMore(array(
                    'userid' => $this->id,
                    'productid' => $id,
                ));
                $check = $GLOBALS['db']->query('SELECT * FROM cart WHERE userid=:userid AND productid=:productid');
                if(count($check) == 0) {
                    $GLOBALS['db']->bindMore(array(
                        'userid' => $this->id,
                        'productid' => $id
                    ));
                    $result = $GLOBALS['db']->query('INSERT INTO cart(userid, productid) VALUES(:userid, :productid)');
                    if($result > 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function deleteFromCart($id) {
            if($this->id != null) {
                $GLOBALS['db']->bindMore(array(
                    'userid' => $this->id,
                    'productid' => $id
                ));
                $result = $GLOBALS['db']->query('DELETE FROM cart WHERE userid=:userid AND productid=:productid');
                if($result > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function updateCartQuantity($id, $qty) {
            if($this->id != null) {
                $GLOBALS['db']->bindMore(array(
                    'userid' => $this->id,
                    'productid' => $id,
                ));
                $check = $GLOBALS['db']->query('SELECT * FROM cart WHERE userid=:userid AND productid=:productid');
                if(count($check) != 0) {
                    $GLOBALS['db']->bindMore(array(
                        'userid' => $this->id,
                        'productid' => $id,
                        'qty' => $qty
                    ));
                    $result = $GLOBALS['db']->query('UPDATE cart SET qty=:qty WHERE userid=:userid AND productid=:productid');
                    if($result > 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function buyCart($aid) {
            $GLOBALS['db']->bind('userid', $this->id);
            $cart = $GLOBALS['db']->query('SELECT productid, qty FROM cart WHERE userid=:userid');

            if(count($cart) != 0) {
                $GLOBALS['db']->bindMore(array(
                    'userid' => $this->id,
                    'aid' => $aid
                ));
                $addCheck = $GLOBALS['db']->query('SELECT * FROM address WHERE userid=:userid AND id=:aid');

                if(count($addCheck) != 0) {
                    $GLOBALS['db']->bindMore(array(
                        'userid' => $this->id,
                        'addressid' => $aid
                    ));
                    $GLOBALS['db']->query('INSERT INTO purchase(userid, addressid) VALUES(:userid, :addressid)');

                    $GLOBALS['db']->bindMore(array(
                        'userid' => $this->id,
                        'uid' => $this->id,
                        'aid' => $aid
                    ));
                    $result = $GLOBALS['db']->query('SELECT id FROM purchase WHERE userid=:userid AND addressid=:aid AND timestamp = ( SELECT MAX(timestamp) FROM purchase WHERE userid =:uid GROUP BY userid )');
                    $purchaseid = $result[0]['id'];

                    foreach($cart as $item) {
                        $GLOBALS['db']->bindMore(array(
                            'purchaseid' => $purchaseid,
                            'productid' => $item['productid'],
                            'qty' => $item['qty']
                        ));
                        $GLOBALS['db']->query('INSERT INTO solditems VALUES(:purchaseid, :productid, :qty)');

                        $GLOBALS['db']->bindMore(array(
                            'userid' => $this->id,
                            'productid' => $item['productid']
                        ));
                        $GLOBALS['db']->query('DELETE FROM cart WHERE userid=:userid AND productid=:productid');
                    }
                }
            }
        }

        public function getOrderHistory() {
            $GLOBALS['db']->bind('userid', $this->id);
            $results = $GLOBALS['db']->query('SELECT pu.id purchaseid, p.id pid, p.catid catid, p.name, p.price price, p.instock instock, p.description description, s.qty qty, a.id aid, a.name aname, a.mobile amobile, a.address adetails, pu.timestamp timestamp FROM purchase pu INNER JOIN solditems s ON s.purchaseid=pu.id INNER JOIN address a ON a.id=pu.addressid INNER JOIN products p ON p.id=s.productid WHERE pu.userid=:userid');
            $orders = array();
            foreach($results as $result) {
                $orders[$result['purchaseid']][] = array(
                    'pid' => $result['pid'],
                    'catid' => $result['catid'],
                    'name' => $result['name'],
                    'price' => $result['price'],
                    'instock' => $result['instock'],
                    'description' => $result['description'],
                    'qty' => $result['qty'],
                    'aid' => $result['aid'],
                    'aname' => $result['aname'],
                    'amobile' => $result['amobile'],
                    'adetails' => $result['adetails'],
                    'timestamp' => $result['timestamp']
                );
            }

            return $orders;
        }

        public function loadAddress() {
            $GLOBALS['db']->bind('id', $this->id);
            $result = $GLOBALS['db']->query('SELECT * FROM address WHERE userid=:id');
            return $result;
        }

        public function addAddress($name, $mobile, $address) {
            $GLOBALS['db']->bindMore(array(
                'userid' => $this->id,
                'name' => $name
            ));
            $check = $GLOBALS['db']->query('SELECT id FROM address WHERE userid=:userid AND name=:name');

            if(count($check) == 0) {
                $GLOBALS['db']->bindMore(array(
                    'userid' => $this->id,
                    'name' => $name,
                    'mobile' => $mobile,
                    'address' => $address
                ));
                $result = $GLOBALS['db']->query('INSERT INTO address(userid, name, mobile, address) VALUES(:userid, :name, :mobile, :address)');

                if($result > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function updateAddress($id, $name, $mobile, $address) {
            $GLOBALS['db']->bindMore(array(
                'userid' => $this->id,
                'id' => $id
            ));
            $check = $GLOBALS['db']->query('SELECT * FROM address WHERE userid=:userid AND id=:id');

            if(count($check) > 0) {
                $GLOBALS['db']->bindMore(array(
                    'userid' => $this->id,
                    'name' => $name
                ));
                $check2 = $GLOBALS['db']->query('SELECT id FROM address WHERE userid=:userid AND name=:name');

                if(count($check2) == 0 || $check2[0]['id'] == $id) {
                    $GLOBALS['db']->bindMore(array(
                        'userid' => $this->id,
                        'id' => $id,
                        'name' => $name,
                        'mobile' => $mobile,
                        'address' => $address
                    ));
                    $result = $GLOBALS['db']->query('UPDATE address SET name=:name, mobile=:mobile, address=:address WHERE userid=:userid AND id=:id');

                    if($result > 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function deleteAddress($id) {
            $GLOBALS['db']->bindMore(array(
                'userid' => $this->id,
                'id' => $id
            ));
            $result = $GLOBALS['db']->query('DELETE FROM address WHERE userid=:userid AND id=:id');

            if($result > 0) {
                return true;
            } else {
                return false;
            }
        }
    }