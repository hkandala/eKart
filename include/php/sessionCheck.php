<?php
    require_once dirname(__FILE__) . '/User.class.php';

    session_start();
    if(!isset($_SESSION['user'])) {
	    header("Location: ../../index.php");
    }

    $userId = $_SESSION['user'];
    $user = new User();
    $user->loadUser($userId);