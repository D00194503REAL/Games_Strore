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

        <script>

            function ajaxFillAccessLevelList()
            {
                var fileName = "ajaxGetAccessLevels.php";   /* use POST method to send data to ajax_json_search.php */
                var method = "POST";
                var urlParameterStringToSend = "";   /* Construct a url parameter string to POST to fileName */


                var http_request;
                if (window.XMLHttpRequest)
                {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    http_request = new XMLHttpRequest();
                } else
                {
                    // code for IE6, IE5
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                }


                http_request.onreadystatechange = function ()
                {
                    if ((http_request.readyState === 4) && (http_request.status === 200))
                    {
                        read_http_request_data(http_request.responseText);
                    }
                };
                http_request.open(method, fileName, true);
                http_request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                http_request.send(urlParameterStringToSend);


                function read_http_request_data(data)
                {
                    var accessLevelDetails = JSON.parse(data);
                    var htmlString = "<select id = 'accessLevel' name = 'accessLevel' required>";
                    htmlString += "<option value=''>Select Access Level</option>";
                    for (var i = 0; i < accessLevelDetails.length; i++)
                    {
                        htmlString += "<option value='" + accessLevelDetails[i].id + "'>" + accessLevelDetails[i].name + "</option>";
                    }
                    htmlString += "</select>";
                    document.getElementById('accessLevelDiv').innerHTML = htmlString;
                }
            }
        </script>
    </head>


    <body onload="ajaxFillAccessLevelList()">

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
                        /* Show error message for any user input errors if this form was previously submitted */
                        if (isset($_SESSION["error_message"])) {
                            echo "<div class='error_message'><p>" . $_SESSION["error_message"] . "<br>Please input data again.</p></div>";
                            unset($_SESSION["error_message"]);
                        }
                        ?>


                        <form id="dkit_confirm_registration_form" action="confirm_registration_transaction.php" method="post">
                            <input type="hidden" id ="token" name = "token">
                            <label for="name">Name: </label>
                            <input type="text" id = "name" name = "name" required autofocus><br>

                            <label for="email">Email: </label>
                            <input type="email" id = "email" name = "email" required><br>

                            <label for="password">Password: </label>
                            <input type="password" id = "password" name = "password" required><br>

                            <label for="confirmPassword">Confirm Password: </label>
                            <input type="password" id = "confirmPassword" name = "confirmPassword" required><br>

                            <label for="accessLevel">Access Level: </label>
                            <span id="accessLevelDiv"></span>
                            <br>

                            <input type="submit" value="Activate Account">
                        </form>














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
        <script>
    /* get the 'token' from the url */
    function getURLValue(name)
    {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regexS = "[\\?&]" + name + "=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(window.location.href);
        if (results === null)
            return null;
        else
            return results[1];
    }

    document.getElementById('token').value = getURLValue('token');
        </script>
    </body>

</html>