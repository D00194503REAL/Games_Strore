<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

        <title>Eurogamer</title>
        <link rel="icon" href="images/logo.png">

        <!-- Loading third party fonts -->
        <link href="http://fonts.googleapis.com/css?family=Roboto:100,300,400,700|" rel="stylesheet" type="text/css">
        <link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="fonts/lineo-icon/style.css" rel="stylesheet" type="text/css">

        <!-- Loading main css file -->
        <link rel="stylesheet" href="style.css">

        <!--[if lt IE 9]>
        <script src="js/ie-support/html5.js"></script>
        <script src="js/ie-support/respond.js"></script>
        <![endif]-->

    </head>

    <body class="slider-collapse">

        <div id="site-content">
            <div class="site-header">
                <div class="container">
                    <a href="index.php" id="branding">
                        <img src="images/logo.png" alt="" class="logo">
                        <div class="logo-text">
                            <h1 class="site-title">Eurogamer</h1>
                            <small class="site-description">The happiest place on earth.</small>
                        </div>
                    </a> <!-- #branding -->

                    <div class="right-section pull-right">
                        <a href="cart.php" class="cart"><i class="icon-cart"></i><span class="badge"><?php
                                if (isset($_SESSION["shopping_cart"])) {
                                    echo count($_SESSION["shopping_cart"]);
                                } else {
                                    echo '0';
                                }
                                ?></span></a>
                        <?php
                        if (isset($_SESSION["user_name"])) {
                            ?>
                            <a href="members_area.php">My Account</a>
                            <?php
                            if ($_SESSION["access_level"] == 1) {
                                ?>
                                <a href="admin_panel.php">Admin Panel</a>
                            <?php }
                            ?>
                            <a href="logout_transaction.php">Logout<small>(<?php echo $_SESSION["user_name"]; ?>)</small></a>
                            <?php
                        } else {
                            ?>
                            <a href="#" class="login-button">Login/Register</a>
                            <?php
                        }
                        ?>
                    </div> <!-- .right-section -->

                    <div class="main-navigation">
                        <button class="toggle-menu"><i class="fa fa-bars"></i></button>
                        <ul class="menu">
                            <li class="menu-item home current-menu-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="menu-item"><a href="products.php">Accessories</a></li>
                            <li class="menu-item"><a href="products.php">Promotions</a></li>
                            <li class="menu-item"><a href="products.php">PC</a></li>
                            <li class="menu-item"><a href="products.php">Playstation</a></li>
                            <li class="menu-item"><a href="products.php">Xbox</a></li>
                            <li class="menu-item"><a href="products.php">Wii</a></li>
                        </ul> <!-- .menu -->
                        <div class="search-form">
                            <label><img src="images/icon-search.png"></label>
                            <input type="text" placeholder="Search...">
                        </div> <!-- .search-form -->

                        <div class="mobile-navigation"></div> <!-- .mobile-navigation -->
                    </div> <!-- .main-navigation -->
                </div> <!-- .container -->
            </div> <!-- .site-header -->

            <div class="home-slider">
                <ul class="slides">
                    <li data-bg-image="dummy/slide-1.jpg">
                        <div class="container">
                            <div class="slide-content">
                                <h2 class="slide-title">Kill Zone 3</h2>
                                <small class="slide-subtitle">$19.00</small>

                                <p>Killzone 3 is a 2011 first-person shooter video game for the PlayStation 3, developed by Guerrilla Games and published by Sony Computer Entertainment. It is the fourth installment in the Killzone series, the first game in the series to be presented in stereoscopic 3D, and the first to include motion controls using the PlayStation Move. It was released worldwide in February 2011.</p>

                                <a href="cart.php" class="button">Add to cart</a>
                            </div>

                            <img src="dummy/game-cover-1.jpg" class="slide-image">
                        </div>
                    </li>
                    <li data-bg-image="dummy/slide-2.jpg">
                        <div class="container">
                            <div class="slide-content">
                                <h2 class="slide-title">Need for Speed Rivals</h2>
                                <small class="slide-subtitle">$19.00</small>

                                <p>Need for Speed Rivals is a racing video game developed in a collaboration between Ghost Games and Criterion Games, and published by Electronic Arts. It is the twentieth installment in the Need for Speed series. The game was released for Microsoft Windows, PlayStation 3 and Xbox 360 on 19 November 2013, and for PlayStation 4 and Xbox One as launch titles in the same month.</p>

                                <a href="cart.php" class="button">Add to cart</a>
                            </div>

                            <img src="dummy/game-cover-2.jpg" class="slide-image">
                        </div>
                    </li>
                    <li data-bg-image="dummy/slide-3.jpg">
                        <div class="container">
                            <div class="slide-content">
                                <h2 class="slide-title">Call of Duty: Ghosts</h2>
                                <small class="slide-subtitle">$19.00</small>

                                <p>Call of Duty: Ghosts is a 2013 first-person shooter video game developed by Infinity Ward, with assistance from Raven Software, Neversoft and Certain Affinity. Published by Activision, it is the tenth primary installment in the Call of Duty series and the sixth developed by Infinity Ward. The video game was released for Microsoft Windows, PlayStation 3, Xbox 360, and Wii U on November 5, 2013, with Treyarch handling the port for the Wii U. The game was released with the launch of next-generation consoles PlayStation 4 and Xbox One and was the second and final Call of Duty game for the Wii U. On June 29, 2017, the Xbox 360 version was made compatible with the Xbox One.</p>

                                <a href="cart.php" class="button">Add to cart</a>
                            </div>

                            <img src="dummy/game-cover-3.jpg" class="slide-image">
                        </div>
                    </li>
                </ul> <!-- .slides -->
            </div> <!-- .home-slider -->

            <main class="main-content">
                <div class="container">
                    <div class="page">
                        <section>
                            <header>
                                <h2 class="section-title">New Products</h2>
                                <a href="#" class="all">Show All</a>
                            </header>

                            <div class="product-list">
                                <div class="product">
                                    <div class="inner-product">
                                        <div class="figure-image">
                                            <a href="single.php"><img src="dummy/game-1.jpg" alt="Game 1"></a>
                                        </div>
                                        <h3 class="product-title"><a href="#">Alpha Protocol</a></h3>
                                        <small class="price">$19.00</small>
                                        <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                        <a href="cart.php" class="button">Add to cart</a>
                                        <a href="#" class="button muted">Read Details</a>
                                    </div>
                                </div> <!-- .product -->

                                <div class="product">
                                    <div class="inner-product">
                                        <div class="figure-image">
                                            <a href="single.php"><img src="dummy/game-2.jpg" alt="Game 2"></a>
                                        </div>
                                        <h3 class="product-title"><a href="#">Grand Theft Auto V</a></h3>
                                        <small class="price">$19.00</small>
                                        <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                        <a href="cart.php" class="button">Add to cart</a>
                                        <a href="#" class="button muted">Read Details</a>
                                    </div>
                                </div> <!-- .product -->

                                <div class="product">
                                    <div class="inner-product">
                                        <div class="figure-image">
                                            <a href="single.php"><img src="dummy/game-3.jpg" alt="Game 3"></a>
                                        </div>
                                        <h3 class="product-title"><a href="#">Need for Speed rivals</a></h3>
                                        <small class="price">$19.00</small>
                                        <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                        <a href="cart.php" class="button">Add to cart</a>
                                        <a href="#" class="button muted">Read Details</a>
                                    </div>
                                </div> <!-- .product -->

                                <div class="product">
                                    <div class="inner-product">
                                        <div class="figure-image">
                                            <a href="single.php"><img src="dummy/game-4.jpg" alt="Game 4"></a>
                                        </div>
                                        <h3 class="product-title"><a href="#">Big game hunter</a></h3>
                                        <small class="price">$19.00</small>
                                        <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                        <a href="cart.php" class="button">Add to cart</a>
                                        <a href="#" class="button muted">Read Details</a>
                                    </div>
                                </div> <!-- .product -->

                            </div> <!-- .product-list -->

                        </section>

                        <section>
                            <header>
                                <h2 class="section-title">promotion</h2>
                                <a href="#" class="all">Show All</a>
                            </header>

                            <div class="product-list">

                                <div class="product">
                                    <div class="inner-product">
                                        <div class="figure-image">
                                            <a href="single.php"><img src="dummy/game-5.jpg" alt="Game 1"></a>
                                        </div>
                                        <h3 class="product-title"><a href="#">Watch Dogs</a></h3>
                                        <small class="price">$19.00</small>
                                        <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                        <a href="cart.php" class="button">Add to cart</a>
                                        <a href="#" class="button muted">Read Details</a>
                                    </div>
                                </div> <!-- .product -->


                                <div class="product">
                                    <div class="inner-product">
                                        <div class="figure-image">
                                            <a href="single.php"><img src="dummy/game-6.jpg" alt="Game 2"></a>
                                        </div>
                                        <h3 class="product-title"><a href="#">Mortal Kombat X</a></h3>
                                        <small class="price">$19.00</small>
                                        <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                        <a href="cart.php" class="button">Add to cart</a>
                                        <a href="#" class="button muted">Read Details</a>
                                    </div>
                                </div> <!-- .product -->


                                <div class="product">
                                    <div class="inner-product">
                                        <div class="figure-image">
                                            <a href="single.php"><img src="dummy/game-7.jpg" alt="Game 3"></a>
                                        </div>
                                        <h3 class="product-title"><a href="#">Metal Gear Solid V</a></h3>
                                        <small class="price">$19.00</small>
                                        <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                        <a href="cart.php" class="button">Add to cart</a>
                                        <a href="#" class="button muted">Read Details</a>
                                    </div>
                                </div> <!-- .product -->


                                <div class="product">
                                    <div class="inner-product">
                                        <div class="figure-image">
                                            <a href="single.php"><img src="dummy/game-8.jpg" alt="Game 4"></a>
                                        </div>
                                        <h3 class="product-title"><a href="#">Nascar '14</a></h3>
                                        <small class="price">$19.00</small>
                                        <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                        <a href="cart.php" class="button">Add to cart</a>
                                        <a href="#" class="button muted">Read Details</a>
                                    </div>
                                </div> <!-- .product -->

                            </div> <!-- .product-list -->

                        </section>
                    </div>
                </div> <!-- .container -->
            </main> <!-- .main-content -->

            <div class="site-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="widget">
                                <h3 class="widget-title">Information</h3>
                                <ul class="no-bullet">
                                    <li><a href="#">Site map</a></li>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div> <!-- .widget -->
                        </div> <!-- column -->
                        <div class="col-md-2">
                            <div class="widget">
                                <h3 class="widget-title">Consumer Service</h3>
                                <ul class="no-bullet">
                                    <li><a href="#">Secure</a></li>
                                    <li><a href="#">Shipping &amp; Returns</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Orders &amp; Returns</a></li>
                                    <li><a href="#">Group Sales</a></li>
                                </ul>
                            </div> <!-- .widget -->
                        </div> <!-- column -->
                        <div class="col-md-2">
                            <div class="widget">
                                <h3 class="widget-title">My Account</h3>
                                <ul class="no-bullet">
                                    <li><a href="#">Login/Register</a></li>
                                    <li><a href="#">Settings</a></li>
                                    <li><a href="#">Cart</a></li>
                                    <li><a href="#">Order Tracking</a></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </div> <!-- .widget -->
                        </div> <!-- column -->
                        <div class="col-md-6">
                            <div class="widget">
                                <h3 class="widget-title">Join our newsletter</h3>
                                <form action="#" class="newsletter-form">
                                    <input type="text" placeholder="Enter your email...">
                                    <input type="submit" value="Subsribe">
                                </form>
                            </div> <!-- .widget -->
                        </div> <!-- column -->
                    </div><!-- .row -->

                    <div class="colophon">
                        <div class="copy">Copyright 2014 Company name. Designed by Themezy. All rights reserved.</div>
                        <div class="social-links square">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div> <!-- .social-links -->
                    </div> <!-- .colophon -->
                </div> <!-- .container -->
            </div> <!-- .site-footer -->
        </div>

        <div class="overlay"></div>

        <div class="auth-popup popup">
            <a href="#" class="close"><i class="fa fa-times"></i></a>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="section-title">Login</h2>
                    <?php
    /* Show error message for any user input errors if this form was previously submitted */
    if (isset($_SESSION["error_message"]))
    {
        echo "<div class='error_message'><p>" . $_SESSION["error_message"] . "<br>Please input data again.</p></div>";
        unset($_SESSION["error_message"]);
    }
    ?>
                    <form action="login_transaction.php" method="post">
                        <input type="email" id = "email" name = "email" placeholder = "Enter your email" required autofocus>
                        <input type="password" id = "password" name = "password" placeholder = "Enter your password" required><br>
                        <input type="submit" value="Login">
                    </form>

                </div> <!-- .column -->
                <div class="col-md-6">
                    <h2 class="section-title">Create an account</h2>

                    <?php
                    /* Show error message for any user input errors if this form was previously submitted */
                    if (isset($_SESSION["error_message"])) {
                        echo "<div class='error_message'><p>" . $_SESSION["error_message"] . "<br>Please input data again.</p></div>";
                        unset($_SESSION["error_message"]);
                    }
                    ?>

                    <form action="register_new_user_transaction.php" method="post">
                        <input type="email" id = "email" name = "email" placeholder="Email address..." required autofocus>
<!--                                                <input type="email" id = "email" name = "email" required autofocus><br>-->
                        <input type="email" id = "confirmEmail" name = "confirmEmail" placeholder="Confirm Email address..." required>
<!--                                                <input type="email" id = "confirmEmail" name = "confirmEmail" required><br>-->
                        <input type="submit" value="register">
                    </form>
                </div> <!-- .column -->
            </div> <!-- .row -->
        </div> <!-- .auth-popup -->

        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/app.js"></script>

    </body>

</html>