<?php
    require_once dirname(__FILE__) . '/User.class.php';
    require_once dirname(__FILE__) . '/Product.class.php';

    if(isset($_SESSION['user'])) {
        $userId = $_SESSION['user'];
        $user = new User();
        $user->loadUser($userId);
    }

    if(!isset($_SESSION['user'])) {
        echo '
            <header>
                <nav class="original">
                    <div class="nav-wrapper z-depth-1">
                        <img src="img/cart.png" alt="Cart">
                        <a href="index.php" class="logo">e<span>Kart</span></a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#search" class="tooltipped" id="search-trigger" data-position="bottom" data-delay="50" data-tooltip="Search"><i class="mdi-action-search"></i></a></li>
                            <li><a href="#login" class="tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Login"><i class="mdi-action-exit-to-app"></i></a></li>
                        </ul>
                    </div>
                </nav>
                <nav class="search">
                    <div class="nav-wrapper z-depth-1">
                        <form action="products.php" method="get">
                            <div class="input-field">
                                <input name="q" id="search" type="search" required>
                                <label for="search"><i class="mdi-action-search"></i></label>
                                <i class="mdi-navigation-close"></i>
                            </div>
                        </form>
                    </div>
                </nav>
                <div id="login" class="modal">
                    <div class="modal-content">
                        <i class="mdi-navigation-close"></i>
                        <div class="login-block">
                            <h2>Login</h2>
                            <form class="login-form" action="include/php/loginCheck.php" method="post">
                                <div class="input-field">
                                    <i class="mdi-communication-email prefix"></i>
                                    <input type="text" name="email" id="loginEmail" class="validate"/>
                                    <label for="loginEmail">Email ID</label>
                                </div>
                                <div class="input-field">
                                    <i class="mdi-communication-vpn-key prefix"></i>
                                    <input type="password" name="password" id="loginPassword" class="validate"/>
                                    <label for="loginPassword">Password</label>
                                </div>
                                <div class="loadingButton">
                                    <input type="submit" class="btn-large" value="Login"/>
                                    <div class="preloader-wrapper small active">
                                        <div class="spinner-layer spinner-green-only">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="gap-patch">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="feedback"></p>
                                </div>
                            </form>
                            <p>New to our website? <span>Sign Up</span> now!</p>
                        </div>
                        <div class="progress">
                          <div class="indeterminate"></div>
                        </div>
                        <div class="signup-block">
                        </div>
                    </div>
                </div>
            </header>
            <main>
        ';
    } else {
        $cart = $user->loadCart();
        echo '
            <header>
                <nav class="original">
                    <div class="nav-wrapper z-depth-1">
                        <img src="img/cart.png" alt="Cart">
                        <a href="index.php" class="logo">e<span>Kart</span></a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#" class="tooltipped" id="search-trigger" data-position="bottom" data-delay="50" data-tooltip="Search"><i class="mdi-action-search"></i></a></li>
                            <li><a href="#cart" class="tooltipped modal-trigger" data-position="bottom" data-delay="50" data-tooltip="Cart"><i class="mdi-action-shopping-cart"></i></a></li>
                            <li id="cartCount">' . count($cart). '</li>
                            <li><a href="#" class="dropdown-button" data-activates="dropdown1"><i class="mdi-action-account-circle"></i></a></li>
                        </ul>
                    </div>
                </nav>
                <nav class="search">
                    <div class="nav-wrapper z-depth-1">
                        <form action="products.php" method="get">
                            <div class="input-field">
                                <input name="q" id="search" type="search" required>
                                <label for="search"><i class="mdi-action-search"></i></label>
                                <i class="mdi-navigation-close"></i>
                            </div>
                        </form>
                    </div>
                </nav>
                <ul id="dropdown1" class="dropdown-content">
                    <li></i><a href="#" class="username">' . $user->fname . ' ' . $user->lname . '</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="mdi-action-assignment-ind"></i> <span>Account</span></a></li>
                    <li><a href="#"><i class="mdi-action-history"></i> <span>Orders</span></a></li>
                    <li><a href="include/php/logout.php"><i class="mdi-action-exit-to-app"></i> <span>Logout</span></a></li>
                </ul>
                <div id="cart" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <h2>Cart</h2>';
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
                                    <a href="checkout.php" class="btn right">Buy Now</a>
                                </div>
                                <script type="text/javascript">
                                    function cartInit() {
                            ';
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
                    echo '
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="modal-action modal-close waves-effect btn-flat teal-text">Continue Shopping</a>
                    </div>
                </div>
            </header>
            <main>
        ';
    }