<?php
    ob_start();
    require_once dirname(__FILE__) . '/password.php';
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();

    session_start();
    $user = $_POST['email'];
    $pass = $_POST['password'];
    $result = $db->query('SELECT * FROM users WHERE email="' . $_POST['email'] . '"');
    if($result != NULL) {
        $no = count($result);
        if($no==1) {
            if(!(password_verify($pass, $result[0]['password']))) {
                echo ('Wrong Password, Please try again');
            } else {
		        $_SESSION['user'] = $result[0]['id'];
                echo ('Logged In');
            }
        } else {
            echo ('Unknown Error, Please try again');
        }
    } else {
        echo ('User not registered');
    }
    ob_end_flush();