<?php
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();
    require_once dirname(__FILE__) . '/User.class.php';

    session_start();
    if(isset($_SESSION['user'])) {
        $userId = $_SESSION['user'];
        $user = new User($userId);

        if(isset($_REQUEST['qty']) && $_REQUEST['pid']) {
            $qty = $_REQUEST['qty'];
            $pid = $_REQUEST['pid'];
            if($user->updateCartQuantity($pid, $qty)) {
                echo $user->totalCartPrice();
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo 0;
        exit();
    }