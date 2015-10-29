<?php
    session_start();
    require_once 'Db.class.php';
    require_once 'User.class.php';
    $db = new DB();

    if(isset($_SESSION['user'])) {
        $user = new User($_SESSION['user']);
    }

    if(isset($_REQUEST['action']) && isset($_REQUEST['id'])) {
        if(isset($user)) {
            if($_REQUEST['action'] == 0) {
                $user->deleteReview($_REQUEST['id']);
            } else if($_REQUEST['action'] == 1) {
                if(isset($_REQUEST['rating']) && isset($_REQUEST['comment'])) {
                    $user->addReview($_REQUEST['id'], $_REQUEST['rating'], $_REQUEST['comment']);
                }
            } else if($_REQUEST['action'] == 2) {
                if(isset($_REQUEST['rating']) && isset($_REQUEST['comment'])) {
                    $user->editReview($_REQUEST['id'], $_REQUEST['rating'], $_REQUEST['comment']);
                }
            }
        }
        header('location: ../../item.php?id=' . $_REQUEST['id']);
    } else {
        echo "Someting wrong happened.";
    }