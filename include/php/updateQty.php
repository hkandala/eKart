<?php
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();
    require_once dirname(__FILE__) . '/User.class.php';

    session_start();
    if(isset($_SESSION['user'])) {
        $userId = $_SESSION['user'];
        $user = new User();
        $user->loadUser($userId);

        if(isset($_REQUEST['qty']) && $_REQUEST['pid']) {
            $qty = $_REQUEST['qty'];
            $pid = $_REQUEST['pid'];
            $result = $db->query('UPDATE cart SET qty="' . $qty . '" WHERE userid="' . $user->id . '" AND productid="' . $pid . '"');
            echo $user->totalCartPrice();
        } else {
            echo 0;
        }
    } else {
        echo '0';
        exit();
    }