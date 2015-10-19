<?php
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();
    require_once dirname(__FILE__) . '/User.class.php';

    session_start();
    if(isset($_SESSION['user'])) {
        $userId = $_SESSION['user'];
        $user = new User();
        $user->loadUser($userId);

        if(isset($_REQUEST['pid'])) {
            $pid = $_REQUEST['pid'];
            $result = $db->query('DELETE FROM cart WHERE userid="' . $user->id . '" AND productid="' . $pid . '"');
            echo $user->totalCartPrice();
        } else {
            echo 0;
        }
    } else {
        echo '0';
        exit();
    }