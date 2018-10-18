<?php


$stripeToken = ltrim(rtrim(filter_input(INPUT_POST, "stripeToken", FILTER_SANITIZE_STRING)));
if (empty($stripeToken))
{
    header("location: index.php"); // deal with invalid input
    exit();
}

$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING)));
if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
{
    header("location: index.php"); // deal with invalid input
    exit();
}

$numberOfProducts = filter_input(INPUT_POST, "numberOfProducts", FILTER_SANITIZE_NUMBER_INT);
if (!isset($numberOfProducts))
{
    if (!filter_var($numberOfProducts, FILTER_VALIDATE_INT))
    {
        header("location: index.php"); // deal with invalid input
        exit();
    }
}


$total = filter_input(INPUT_POST, "total", FILTER_SANITIZE_NUMBER_INT);
if (!isset($total))
{
    if (!filter_var($total, FILTER_VALIDATE_INT))
    {
        header("location: index.php"); // deal with invalid input
        exit();
    }
}

require_once 'configuration.php';
// make stripe payment
require_once('./Stripe/init.php');
\Stripe\Stripe::setApiKey($privateStripeKey);
try
{
    $charge = \Stripe\Charge::create(array(
                "amount" => $total . "00",
                "currency" => "eur",
                "card" => $stripeToken,
                "description" => "Stripe Sales Example")
    );
}
catch (Stripe_CardError $e)
{
    echo("Your card has been declined.<br>Error Details: " . $e . "<br><br><a href='index.php'>Click here to continue</a>");
    die();
}
catch (Exception $e)
{
    echo("Your card has been declined.<br>Error Details: " . $e . "<br><br><a href='index.php'>Click here to continue</a>");
    die();
}
// end of Stripe payment code
?>




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
                        <a href="cart.php" class="cart"><i class="icon-cart"></i><span class="badge"><?php if (isset($_SESSION["shopping_cart"])) {
    echo count($_SESSION["shopping_cart"]);
} else {
    echo '0';
} ?></span></a>
                        <?php
                        if (isset($_SESSION["user_name"])) {
                            ?>
                            <a href="members_area.php">My Account</a>
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
                        
                        
                        
                        
                        
                        
                        <div class="main-content" style="color: black; font-weight: bold;">

<form class="form-validation" id="dor_payment_form">
    <img src="images/logo.png" style="width:50px" alt=""/> <h1>Eurogamer</h1> <br>
<p>Your payment is confirmed. Thank you for your order.</p>
<a href="index.php">Click here to return to our website</a>
</form>
</div>
                    

    
    
    
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
    <a href="#" class="close"><i class="fa fa-close"></i></a>
    <div class="row">
        <div class="col-md-6">
            <h2 class="section-title">Login</h2>
            <?php
            /* Show error message for any user input errors if this form was previously submitted */
            if (isset($_SESSION["error_message"])) {
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
<?php 
// send confirmation email
$subject = "Eurogamer";
$comment = "Your payment is confirmed. Thank you for your order.";

$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($email, $subject, $comment, $headers);
?>
</html>


