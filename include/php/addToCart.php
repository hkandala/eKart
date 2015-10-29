<?php
    session_start();
    require_once 'Db.class.php';
    require_once 'Product.class.php';
    require_once 'User.class.php';
    $db = new DB();

    if(isset($_REQUEST['item'])) {
        $product = new Product($_REQUEST['item']);
        if ($product->id != null) {
            if(isset($_SESSION['user'])) {
                $user = new User($_SESSION['user']);
                $user->addToCart($product->id);
                header('location: ../../item.php?id=' . $product->id);
            } else {
                header('location: ../../item.php?id=' . $product->id);
            }
        } else {
            header('location: ../../item.php?id=' . $product->id);
        }
    }