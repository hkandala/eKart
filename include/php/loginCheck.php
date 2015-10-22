<?php
    ob_start();
    require_once dirname(__FILE__) . '/password.php';
    require_once dirname(__FILE__) . '/Db.class.php';
    require_once dirname(__FILE__) . '/User.class.php';
    $db = new DB();

    session_start();
    $user = $_POST['email'];
    $pass = $_POST['password'];
    $u = new User();
    if($u->loadUserFromEmail($user)) {
        if(!(password_verify($pass, $u->password))) {
            echo ('Wrong Password, Please try again');
        } else {
            $_SESSION['user'] = $u->id;
            echo ('Logged In');
        }
    } else {
        echo ('User not registered');
    }
    ob_end_flush();