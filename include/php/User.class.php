<?php
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();

    class User {
        public $id;
        public $fname;
        public $lname;
        public $email;
        public $mobile;
        public $dob;

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
                $this->mobile = $result[0]['mobile'];
                $this->dob = $result[0]['dob'];

                return true;
            } else {
                return false;
            }
        }

        public function deleteUser() {
            $result = $GLOBALS['db']->query('DELETE FROM users WHERE id="' . $this->id . '"');
            if($result > 0) {
                $this->id = null;
                $this->fname = null;
                $this->lname = null;
                $this->email = null;
                $this->mobile = null;
                $this->dob = null;

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
            $result = $GLOBALS['db']->query('SELECT * FROM cart uc INNER JOIN products p ON uc.productid=p.id WHERE userid="' . $this->id . '"');
            return $result;
        }

        public function totalCartPrice() {
            $cart = $this->loadCart();
            $total = 0;
            foreach ($cart as $cartItem) {
                $total = $total + $cartItem['price']*$cartItem['qty'];
            }

            return $total;
        }
    }