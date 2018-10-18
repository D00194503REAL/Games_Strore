<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

        <title>Eurogamer</title>
        <link rel="icon" href="images/logo.png">

        <!-- Loading third party fonts -->
        <link href="http://fonts.googleapis.com/css?family=Roboto:100,400,700|" rel="stylesheet" type="text/css">
        <link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="fonts/lineo-icon/style.css" rel="stylesheet" type="text/css">

        <!-- Loading main css file -->
        <link rel="stylesheet" href="style.css">

        <!--[if lt IE 9]>
        <script src="js/ie-support/html5.js"></script>
        <script src="js/ie-support/respond.js"></script>
        <![endif]-->

    </head>


    <body>

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
<!--                            <input type="text" placeholder="Search...">-->
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">
                        </div> <!-- .search-form -->

                        <div class="mobile-navigation"></div> <!-- .mobile-navigation -->
                    </div> <!-- .main-navigation -->

                    <div class="breadcrumbs">
                        <div class="container">
                            <a href="index.php">Home</a>
                            <span>Play Station Games</span>
                        </div>
                    </div>

                </div> <!-- .container -->
            </div> <!-- .site-header -->
            <main class="main-content">
                <div class="container">
                    <div class="page">