<?php
    session_start();
    require_once 'include/php/Db.class.php';
    require_once 'include/php/Product.class.php';
    require_once 'include/php/User.class.php';
    $db = new DB();

    if(isset($_REQUEST['id'])) {
        $productPage = new Product($_REQUEST['id']);
        if ($productPage->id == null) {
            unset($productPage);
        }
        if(isset($_SESSION['user'])) {
            $user = new User($_SESSION['user']);
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
    <title>eKart | <?php echo(isset($productPage) ? $productPage->name :  'Unavailable')?></title>
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

        if(isset($productPage)) {
            $imgs = $productPage->getAllImgs();
            echo '
                <div class="row">
                    <div class="col s4">
                        <div class="card-panel product-image-wrapper">
                            <div class="owl-carousel product-images">
            ';
                                $i = 0;
                                foreach($imgs as $img) {
                                    echo '<div class="item" style="background-image: url(\'' . $img . '\')"></div>';
                                    $i++;
                                }
            echo '
                            </div>';
                            if($i > 1) {
                                echo '
                                    <div class="next-btn"><i class="mdi-navigation-chevron-right"></i></div>
                                    <div class="prev-btn"><i class="mdi-navigation-chevron-left"></i></div>
                                ';
                            }
            echo'
                        </div>
                    </div>
                    <div class="col s8">
                        <div class="card-panel product-desc">
                            <h2>' . $productPage->name . '</h2>
                            <p class="price">Price: Rs. ' . $productPage->price . '</p>
                            <p class="rating">Rating: <span>';
                                if(($rating=$productPage->getAvgRating())=='') {
                                    echo '0';
                                } else {
                                    echo $rating;
                                }
            echo '
                            / 5</span></p>
                            <pre class="description">' . $productPage->description . '</pre>
            ';
                            if($productPage->instock) {
                                if(isset($user)) {
                                    echo '
                                            <a href="include/php/addToCart.php?item=' . $productPage->id . '" class="btn-large orange">Add To Cart</a>
                                            <a href="checkout.php?item=' . $productPage->id . '" class="btn-large deep-orange">Buy Now</a>
                                    ';
                                } else {
                                    echo '
                                            <a href="#login" class="btn-large orange modal-trigger">Add To Cart</a>
                                            <a href="#login" class="btn-large deep-orange modal-trigger">Buy Now</a>
                                    ';
                                }
                            } else {
                                echo '<div class="oos">OUT OF STOCK</div>';
                            }
            echo'

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="product-border"></div>';
                    if(isset($user)) {
                        if($review = $user->loadReview($productPage->id)) {
                            echo '
                                <div class="col s10 push-1 add-review-wrapper">
                                    <h3>Edit Review</h3>
                                    <form id="product-review" action="include/php/reviewManager.php" method="post">
                                        <div class="add-review card-panel">
                                            <a href="include/php/reviewManager.php?action=0&id=' . $productPage->id . '" class="delete-review tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete review"><i class="mdi-navigation-close"></i></a>
                                            <div class="row review-rate">
                                                <div class="input-field col s3 push-1">
                                                    <select name="rating" id="product-review-rating">
                                                        <option value="1" ' . (($review['rating']==1) ? 'selected' : '') . '>1</option>
                                                        <option value="2" ' . (($review['rating']==2) ? 'selected' : '') . '>2</option>
                                                        <option value="3" ' . (($review['rating']==3) ? 'selected' : '') . '>3</option>
                                                        <option value="4" ' . (($review['rating']==4) ? 'selected' : '') . '>4</option>
                                                        <option value="5" ' . (($review['rating']==5) ? 'selected' : '') . '>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row review-comment">
                                                <div class="input-field col s10 push-1">
                                                    <i class="mdi-editor-mode-edit prefix"></i>
                                                    <textarea id="comment" class="materialize-textarea" name="comment">' . $review['comment'] . '</textarea>
                                                    <label for="comment">Your review</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="' . $productPage->id . '">
                                            <input type="hidden" name="action" value="2">
                                            <input type="submit" value="Submit" class="btn-large center-align">
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                            ';
                        } else {
                            echo '
                                <div class="col s10 push-1 add-review-wrapper">
                                    <h3>Add Review</h3>
                                    <form id="product-review" action="include/php/reviewManager.php" method="post">
                                        <div class="add-review card-panel">
                                            <div class="row review-rate">
                                                <div class="input-field col s3 push-1">
                                                    <select name="rating" id="product-review-rating">
                                                        <option value="" disabled selected>Rate the product</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row review-comment">
                                                <div class="input-field col s10 push-1">
                                                    <i class="mdi-editor-mode-edit prefix"></i>
                                                    <textarea id="comment" class="materialize-textarea" name="comment"></textarea>
                                                    <label for="comment">Your review</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="' . $productPage->id . '">
                                            <input type="hidden" name="action" value="1">
                                            <input type="submit" value="Submit" class="btn-large center-align">
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                            ';
                        }
                    }
            echo '
                    <div class="col s10 push-1 product-review-wrapper">
                        <h3>User Reviews</h3>
                        <div class="product-reviews">';
                            $productReviews = $productPage->getAllReviews();
                            if($productReviews != null) {
                                foreach($productReviews as $review) {
                                    echo '
                                        <div class="product-review card-panel">
                                            <div class="review-desc">' . $review['comment'] . '</div>
                                            <div class="review-details">
                                                <p class="left">by ' . $review['fname'] . ' ' . $review['lname'] . '</p>
                                                <span class="right">' . $review['rating'] . ' / 5</span>
                                            </div>
                                        </div>
                                    ';
                                }
                                echo '<div style="margin-bottom: 30px;"></div>';
                            } else {
                                echo '
                                    <div class="product-review card-panel no-reviews">Oops! No reviews found for this product.</div>
                                ';
                            }
            echo '
                        </div>
                        </div>
                    </div>
                </div>
            ';
        } else {
            echo '
                <div class="no-products">Sorry, no products found :(</div>
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