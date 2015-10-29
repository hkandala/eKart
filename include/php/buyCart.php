<?php
    session_start();
    require_once 'Db.class.php';
    require_once 'User.class.php';

    $db = new DB();

    if(isset($_SESSION['user'])) {
        $user = new User($_SESSION['user']);
        $user->buyCart(1); //For time being using only address with id 1
        echo '
            <h2 style="font-family: sans-serif; color: #263238; font-size: 25px; text-align: center; margin-top: 300px;">Thanks for shopping with us. Your order will arrive soon.</h2>
            <script type="text/javascript">
                setTimeout(function() {
                    window.location = "../../index.php";
                }, 3000)
            </script>
        ';
    } else {
        echo "Something wrong happened. Please try again.";
    }