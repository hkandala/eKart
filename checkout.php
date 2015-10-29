<?php
    session_start();
    require_once 'include/php/Db.class.php';
    require_once 'include/php/Product.class.php';
    require_once 'include/php/User.class.php';
    $db = new DB();
    $page = "checkout";

    if(isset($_SESSION['user'])) {
        $user = new User($_SESSION['user']);
    }

    if(isset($_REQUEST['item'])) {
        if(isset($user)) {
            $user->addToCart($_REQUEST['item']);
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" class="no-js">
<head>
    <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Harish Kandala">
    <meta name="description" content="eKart is a sample ecommerce website with all necessary features">
    <meta name="keywords" content="Ecommerce, Shopping, Buy, Sale, Cart, eKart">
    <title>eKart | Checkout</title>
    <link rel="icon" href="img/cart.png">
    <!-----------------------------Stylesheets---------------------------->
    <link rel="stylesheet" type="text/css" href="include/css/styles.css">
    <link rel="stylesheet" href="include/css/owl.carousel.css">
    <link rel="stylesheet" href="include/css/owl.theme.css">
    <!-------------------------------------------------------------------->
    <script src="include/js/init.js" type="text/javascript"></script>
</head>
<body>
    <?php
        require_once 'include/php/header.php';
        $cart = $user->loadCart();

        echo '
            <div id="cart" class="checkout">
                <h2>Checkout</h2>';
                if($cart!=null) {
                    echo '
                        <ul class="collection">';
                            $i = 0;
                            foreach($cart as $cartItem) {
                                $product = new Product($cartItem['productid']);
                                $img = $product->getImg();
                                echo '
                                    <li class="collection-item row item' . $i . '">
                                        <div class="overlay"><p>REMOVED</p></div>
                                        <i class="mdi-navigation-close" id="close' . $i . '"></i>
                                        <div class="thumb col s3" style="background-image: url(\'' . $img . '\');"></div>
                                        <div class="details col s9">
                                            <a href="item.php?id=' . $cartItem['productid'] . '">' . $cartItem['name'] . '</a>
                                            <p>Price: Rs.' . $cartItem['price'] . '</p>
                                            <p class="qty">Quantity: </p>
                                            <input id="cartItem' . $i . '" type="text" value="' . $cartItem['qty'] . '"/>
                                        </div>
                                        <script type="text/javascript">
                                            function cartLoad' . $i . '() {
                                                $("#cart #cartItem' . $i . '").on("input", function () {
                                                    $.post("include/php/updateQty.php", {"qty": $("#cart #cartItem' . $i . '").val(), "pid": ' . $cartItem['productid'] . '}, function(response) {
                                                        $("#cart #totalPrice").html(response);
                                                    });
                                                });
                                                $("#cart #close' . $i . '").on("click", function () {
                                                    $("#cart .item' . $i . ' .overlay").fadeIn();
                                                    $("#cartCount").html($("#cartCount").html() - 1);
                                                    $.post("include/php/deleteCartItem.php", {"pid": ' . $cartItem['productid'] . '}, function(response) {
                                                        $("#cart #totalPrice").html(response);
                                                    });
                                                });
                                            }
                                        </script>
                                    </li>
                                ';
                                $i++;
                            }
                    echo '
                        </ul>
                        <div class="card-panel s12">
                            <p>Total Price: Rs.<span id="totalPrice">' . $user->totalCartPrice() . '</span></p>
                            <a href="include/php/buyCart.php" class="btn right">Buy Now</a>
                        </div>
                        <script type="text/javascript">
                            function cartInit() {';
                                while($i>0) {
                                    $i--;
                                    echo 'cartLoad' . $i . '();';
                                }
                    echo  '}
                        </script>
                    ';
                } else {
                    echo '
                        <div class="emptyCart">
                            <h3>There are no items in the cart :(</h3>
                        </div>
                        ';
                }

        require_once 'include/php/footer.php';
    ?>

<!--------------------------Scripts--------------------------------->
<script src="include/js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="include/js/materialize.min.js" type="text/javascript"></script>
<script src="include/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="include/js/app.js" type="text/javascript"></script>
<!------------------------------------------------------------------>
</body>
</html>