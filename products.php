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
    <title>eKart | Products</title>
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

    if(!isset($_REQUEST['catid']) && !isset($_REQUEST['q'])) {
?>
        <div class="all-products products-page">
            <?php
                $products = Util::getAllProducts();
                $i = 0;
                foreach ($products as $product) {
                    echo '
                        <div class="category cat-' . $i . '">
                            <a href="products.php?catid=' . $product['catid'] . '" class="cat-title">' . $product['catname'] . '</a>
                            <div id="owl-demo-' . $i . '" class="products owl-carousel">';
                            foreach ($product as $productItem) {
                                if (is_array($productItem)) {
                                    echo '
                                        <div class="item card-panel">
                                            <div class="image" style="background-image: url(\'' . Util::getImg($productItem['id']) . '\')">';
                                            if(!$productItem['instock']) {
                                                echo '
                                                    <div class="os-overlay z-depth-1">OUT OF STOCK</div>
                                                ';
                                            }
                                    echo '
                                            </div>
                                            <a href="item.php?id=' . $productItem['id'] . '" class="title">' . $productItem['name'] . '</a>
                                            <div class="price">Rs.' . $productItem['price'] . '</div>
                                        </div>
                                    ';
                                }
                            }
                    echo '
                            </div>
                            <div class="next-btn"><i class="mdi-navigation-chevron-right"></i></div>
                            <div class="prev-btn"><i class="mdi-navigation-chevron-left"></i></div>
                        </div>
                    ';
                    $i++;
                }
            ?>
        </div>
<?php
    } else {
        $product = Util::getAllProducts(isset($_REQUEST['catid']) ? $_REQUEST['catid'] : Util::getCategoryStr(), isset($_REQUEST['q']) ? $_REQUEST['q'] : null, isset($_REQUEST['p']) ? $_REQUEST['p'] : null, isset($_REQUEST['rt']) ? $_REQUEST['rt'] : null, isset($_REQUEST['ra']) ? $_REQUEST['ra'] : null, isset($_REQUEST['os']) ? $_REQUEST['os'] : null);
        if($product != null) {
            echo '
                <a href="#" class="cat-title common">';
                if(isset($_REQUEST['q'])) {
                    echo '
                        Showing search results for \'' . $_REQUEST['q'] . '\'
                        <span>' . $product['count'] . ' result';
                    if($product['count'] == 1) {
                        echo ' found</span>';
                    } else {
                        echo 's found</span>';
                    }
                } else {
                    if(isset($product['catname'])) {
                        echo $product['catname'];
                    } else {
                        echo 'Refined Results';
                    }
                }
            echo'
                </a>
                <div class="row">
                    <div class="sidebar col s2">
                        <div class="card-panel">
                            <h4>Refine</h4>
                            <form id="refineForm" action="products.php" method="get">
                                <p>Categories</p>
                                <div class="cat-sub-form">';
                                    $categories = Util::getAllCategories();
                                    foreach($categories as $category) {
                                        echo '
                                            <div>
                                                <input type="checkbox" class="filled-in" id="cat-';
                                                echo $category['id'] . '" ';
                                                if(Util::isCategoryChecked($category['id'])) {
                                                    echo 'checked="checked"';
                                                }
                                        echo '
                                                 />
                                                <label for="cat-' . $category['id'] . '">' . $category['name'] . '</label>
                                            </div>
                                        ';
                                    }
                            echo '
                                </div>
                                <p>Price</p>
                                <div>
                                    <input type="checkbox" class="filled-in" id="p-1" ';
                                    if(isset($_REQUEST['p']) && $_REQUEST['p']==1) {
                                        echo 'checked="checked"';
                                    }
                            echo ' />
                                    <label for="p-1">High to Low</label>
                                </div>
                                <div>
                                    <input type="checkbox" class="filled-in" id="p-2" ';
                                    if(isset($_REQUEST['p']) && $_REQUEST['p']!=1) {
                                        echo 'checked="checked"';
                                    }
                            echo ' />
                                    <label for="p-2">Low to High</label>
                                </div>
                                <p>Rating</p>
                                <div>
                                    <input type="checkbox" class="filled-in" id="rt-1" ';
                                    if(isset($_REQUEST['rt']) && $_REQUEST['rt']==1) {
                                        echo 'checked="checked"';
                                    }
                            echo ' />
                                    <label for="rt-1">High to Low</label>
                                </div>
                                <div>
                                    <input type="checkbox" class="filled-in" id="rt-2" ';
                                    if(isset($_REQUEST['rt']) && $_REQUEST['rt']!=1) {
                                        echo 'checked="checked"';
                                    }
                            echo ' />
                                    <label for="rt-2">Low to High</label>
                                </div>
                                <p>Time</p>
                                <div>
                                    <input type="checkbox" class="filled-in" id="ra-1" ';
                                    if(isset($_REQUEST['ra']) && $_REQUEST['ra']==1) {
                                        echo 'checked="checked"';
                                    }
                            echo ' />
                                    <label for="ra-1">Newest First</label>
                                </div>
                                <div>
                                    <input type="checkbox" class="filled-in" id="ra-2" ';
                                    if(isset($_REQUEST['ra']) && $_REQUEST['ra']!=1) {
                                        echo 'checked="checked"';
                                    }
                            echo ' />
                                    <label for="ra-2">Oldest First</label>
                                </div>
                                <div class="os-box">
                                    <input type="checkbox" class="filled-in" id="os" ';
                                    if(isset($_REQUEST['os']) && $_REQUEST['os']==1) {
                                        echo 'checked="checked"';
                                    }
                            echo ' />
                                    <label for="os">Include out of stock products</label>
                                </div>
                                <input type="hidden" id="ip-catid" name="catid" value="';
                                if(isset($_REQUEST['catid'])) {
                                    echo $_REQUEST['catid'];
                                }
                        echo '">
                                <input type="hidden" id="ip-p" name="p" value="';
                                if(isset($_REQUEST['p'])) {
                                    echo $_REQUEST['p'];
                                }
                        echo '">
                                <input type="hidden" id="ip-rt" name="rt" value="';
                                if(isset($_REQUEST['rt'])) {
                                    echo $_REQUEST['rt'];
                                }
                        echo '">
                                <input type="hidden" id="ip-ra" name="ra" value="';
                                if(isset($_REQUEST['ra'])) {
                                    echo $_REQUEST['ra'];
                                }
                        echo '">
                                <input type="hidden" id="ip-os" name="os" value="';
                                if(isset($_REQUEST['os'])) {
                                    echo $_REQUEST['os'];
                                }
                        echo '">
                                <input type="hidden" id="ip-q" name="q" value="';
                                if(isset($_REQUEST['q'])) {
                                    echo $_REQUEST['q'];
                                }
                        echo '">
                            </form>
                        </div>
                    </div>
                    <div class="all-products products-page col s10">
                        <div class="category products-list-page">
                            <div class="products-list row">';
                            $i = 0;
                            foreach ($product as $productItem) {
                                if (is_array($productItem)) {
                                    echo '
                                        <div class="item col s3">
                                            <div class="padding-box card-panel">
                                                <div class="image" style="background-image: url(\'' . Util::getImg($productItem['id']) . '\')">';
                                                if(!$productItem['instock']) {
                                                    echo '
                                                         <div class="os-overlay z-depth-1">OUT OF STOCK</div>
                                                    ';
                                                }
                                    echo '
                                                </div>
                                                <a href="item.php?id=' . $productItem['id'] . '" class="title">' . $productItem['name'] . '</a>
                                                <div class="price">Rs.' . $productItem['price'] . '</div>
                                            </div>
                                        </div>
                                    ';
                                    $i++;
                                    if($i == 4) {
                                        echo '<div class="clearfix"></div>';
                                        $i = 0;
                                    }
                                }
                            }
                        echo '
                            </div>
                        </div>
                    </div>
                </div>';
        } else {
            echo '
                <div class="no-products">Sorry, no products found :(</div>
            ';
        }
    }
?>

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