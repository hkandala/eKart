<?php
    session_start();
    require_once 'include/php/Db.class.php';
    require_once 'include/php/Util.class.php';
    $db = new DB();
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
    <title>eKart | Home</title>
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
    ?>

    <div id="owl-demo" class="owl-carousel owl-theme">
        <div class="item"><img src="img/slide1.jpg" alt="Slide"></div>
        <div class="item"><img src="img/slide2.jpg" alt="Slide"></div>
        <div class="item"><img src="img/slide3.jpg" alt="Slide"></div>
    </div>

    <div class="all-products">
        <?php
            $products = Util::getAllProducts();
            $i = 0;
            foreach($products as $product) {
                echo '
                    <div class="category cat-' . $i . '">
                        <a href="products.php?catid=' . $product['catid'] . '" class="cat-title">' . $product['catname'] . '</a>
                        <div id="owl-demo-' . $i . '" class="products owl-carousel">';
                            foreach ($product as $productItem) {
                                if(is_array($productItem)) {
                                    if ($productItem['instock']) {
                                        echo '
                                            <div class="item card-panel">
                                                <div class="image" style="background-image: url(\'' . Util::getImg($productItem['id']) . '\')"></div>
                                                <a href="item.php?id=' . $productItem['id'] . '" class="title">' . $productItem['name'] . '</a>
                                                <div class="price">Rs.' . $productItem['price'] . '</div>
                                            </div>
                                        ';
                                    }
                                }
                            }
                echo '
                        </div>
                        <div class="next-btn"><i class="mdi-navigation-chevron-right"></i></div>
                        <div class="prev-btn"><i class="mdi-navigation-chevron-left"></i></div>
                    </div>
                ';
                $i++;
                if($i == 4) {
                    break;
                }
            }
        ?>
        <a href="products.php" class="btn-large blue-grey see-all">Browse through all of our products</a>
    </div>

    <?php
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