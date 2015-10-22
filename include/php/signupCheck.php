<?php
    ob_start();
    require_once dirname(__FILE__) . '/password.php';
    require_once dirname(__FILE__) . '/Db.class.php';
    $db = new DB();
    require_once dirname(__FILE__) . '/User.class.php';

    session_start();
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phoneno = $_POST['phoneno'];
    $dob = $_POST['dob'];

    $user = new User();
    if(!$user->loadUserFromEmail($_POST['email'])) {
        if(($password != NULL) && ($fname != NULL) && ($lname != NULL) && ($email != NULL)) {
            if($user->newUser($fname, $lname, $email, password_hash($password, PASSWORD_DEFAULT), $phoneno, $dob)) {
                echo ('You have successfully registered');
            } else {
                echo ('Something wrong happened, Please try again');
            }
        } else {
            echo ('Something wrong happened, Please try again');
        }
    } else {
        echo ('This email is already registered');
    }
    ob_end_flush();