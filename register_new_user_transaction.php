<?php
session_start();

/* Read posted data */
require_once "error_messages.php";  // contains a list of error messages that can be assigned to $_SESSION["error_message"]

$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)));
if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: register_new_user.php"); // deal with invalid input
    exit();
}

$confirmEmail = ltrim(rtrim(filter_input(INPUT_POST, "confirmEmail", FILTER_SANITIZE_EMAIL)));
if ((empty($confirmEmail)) || (!filter_var($confirmEmail, FILTER_VALIDATE_EMAIL))) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: register_new_user.php"); // deal with invalid input
    exit();
}


/* Validate input data */
if ($email != $confirmEmail) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_EMAILS_DO_NOT_MATCH;
    header("location: register_new_user.php");
}


/* Connect to the database */
require_once "configuration.php";



/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



/* Check that user is not already user_added  */
$query = "SELECT email FROM users WHERE email = :email";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->execute();

if ($statement->rowCount() > 0) {
    $_SESSION["error_message"] = $ERROR_MESSAGE_EMAIL_ALREADY_REGISTERED;
    header("location: index.php");
    exit();
}


/* Check that the user is not already pending */
$query = "DELETE FROM pending_users WHERE email = :email";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->execute();


/* Create new pending user */
$expiry_time_stamp = 1200 + $_SERVER["REQUEST_TIME"]; // 1200 = 20 minutes from now
$token = sha1(uniqid($email, true));

$query = "INSERT INTO pending_users (token, email, expiry_time_stamp) VALUES (:token, :email, :expiry_time_stamp)";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":token", $token, PDO::PARAM_STR);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->bindParam(":expiry_time_stamp", $expiry_time_stamp, PDO::PARAM_INT);
$statement->execute();


/* remove all old pending users from database */
$query = "DELETE FROM pending_users WHERE expiry_time_stamp < :expiry_time_stamp";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":expiry_time_stamp", $_SERVER["REQUEST_TIME"], PDO::PARAM_INT);
$statement->execute();
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
                        <a href="cart.php" class="cart"><i class="icon-cart"></i> 0 items in cart</a>
                        <a href="#">My Account</a>
                        <a href="#">Logout <small>(John Smith)</small></a>
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







<?php
/* Provide feedback and provide a way for the user to proceed or automatically redirect to a new webpage */

echo "<p>In the real world, the user will either be registering remotely or they will be registered by an administrator.<br>";
echo "If the user is registering remotely, then forward the url below to them in a email.<br>";
echo "If the user is being registered by an administrator, then automatically redirect to the url below.</p>";
echo "<br>";
echo "<a href ='" . $siteName . '/confirm_registration.php?token=' . $token . "'>" . $siteName . '/confirm_registration.php?token=' . $token . "</a>";
echo "<br><br><br>";

echo "<h3 style='color:red'>Below is an axample content that can be used if sending a registration confirmation email to the user</h3>";
echo "An email has been sent to you to activate your new account.<br><br>" .
 "If you do not receive an email, please check your junk folder for an email from us. Our email is:<br>" .
 "<strong>D00194503.student.dkit.ie</strong><br><br>" .
 "If you still cannot find our email, please add our email address to your email whitelist and attempt to recover your email again.<br><br>";



$subject = "DkIT Login Example Register New User";
$comment = "You are receiving this email because you requested to register with DkIT Login Example." .
        " If you did not request to register with us, then simply ignore this email.<br><br>" .
        "Click on the link below to register:<br>" .
        "<a href = '" . $siteName . "/confirm_registration.php?token=" . $token . "'>" . $siteName . '/confirm_registration.php?token=' . $token . "</a><br><br>" .
        "If the link above does not work, then cut-and-paste it into your browser address bar and run it from there.<br><br>" .
        "<br><br>Yours Sincerly<br>DkIT Login Example Registration Team";

$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($email, $subject, $comment, $headers);
?>








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
                    <form action="#">
                        <input type="text" placeholder="Username...">
                        <input type="password" placeholder="Password...">
                        <input type="submit" value="Login">
                    </form>
                </div> <!-- .column -->
                <div class="col-md-6">
                    <h2 class="section-title">Create an account</h2>
                    <form action="#">
                        <input type="text" placeholder="Username...">
                        <input type="text" placeholder="Email address...">
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