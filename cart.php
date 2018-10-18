<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "D00194503");

if (isset($_SESSION["user_name"])) {
    if (isset($_SESSION["shopping_cart"])) {
    $numberOfProducts = count($_SESSION["shopping_cart"]);
    }
    $email = $_SESSION["user_email"];
}
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
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,700|" rel="stylesheet" type="text/css">
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
                            <input type="text" placeholder="Search...">
                        </div> <!-- .search-form -->

                        <div class="mobile-navigation"></div> <!-- .mobile-navigation -->
                    </div> <!-- .main-navigation -->

                    <div class="breadcrumbs">
                        <div class="container">
                            <a href="index.php">Home</a>
                            <span>Cart</span>
                        </div>
                    </div>
                </div> <!-- .container -->
            </div> <!-- .site-header -->
            <main class="main-content">
                <div class="container">
                    <div class="page">



























                        <table class="cart">
                            <thead>
                                <tr>
                                    <th class="product-name">Product Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-qty">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="action"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM tbl_product ORDER BY id ASC";
                                $result = mysqli_query($connect, $query);
                                $row = mysqli_fetch_array($result);
                                if (!empty($_SESSION["shopping_cart"])) {
                                    $total = 0;
                                    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                                        ?>  
                                        <tr>
                                            <td class="product-name">
                                                <div class="product-thumbnail">
                                                    <img src="images/<?php echo $values["product_id"] . ".jpg"; ?>" class="img-responsive" />
                                                </div>
                                                <div class="product-detail">
                                                    <h3 class="product-title"><?php echo $values["product_name"]; ?></h3>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure nobis architecto dolorum, alias laborum sit odit, saepe expedita similique eius enim quasi obcaecati voluptates, autem eveniet ratione veniam omnis modi.</p>
                                                </div>
                                            </td>
                                            <td class="product-price">$<?php echo $values["product_price"]; ?></td>
                                            <td><input onChange="window.location.reload()" style="width: 100%;" type="text" name="quantity[]" id="quantity<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>" data-product_id="<?php echo $values["product_id"]; ?>" class="form-control quantity" /></td>
                                            <td class="product-total">$<?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?></td>
                                            <td><button name="delete" class="button btn-danger btn-xs delete" id="<?php echo $values["product_id"]; ?>" onClick="window.location.reload()">Remove</button></td>
                                        </tr>
                                        <?php
                                        $total = $total + ($values["product_quantity"] * $values["product_price"]);
                                    }
                                    ?>  
                                </tbody>
                                <?php
                            }
                            ?>  
                        </table> <!-- .cart -->

                        <div class="cart-total">

                            <p style="text-align: center" class="total"><strong>Total</strong><span class="num">$ 
                                    <?php
                                    if (!empty($_SESSION["shopping_cart"])) {

                                        echo number_format($total, 2);
                                    } else {
                                        $total = 0;
                                        echo $total;
                                    }
                                    ?>
                                </span></p>
                            <p>
                                
                                
                                <?php require_once 'configuration.php'; ?>

<?php
if (isset($_SESSION["user_name"])) {
    ?>
                                <form  action="payment_confirmation.php" style="text-align: center" method="post">
                                    
                                    <input type="hidden" name = "email" value = "<?php echo $email ?>">
                                    <input type="hidden" name = "numberOfProducts" value = "<?php echo $numberOfProducts ?>">
                                    <input type="hidden" name = "total" value = "<?php echo $total ?>">
                                    
                                    <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"    

                                        data-key="<?php echo $publicStripeKey ?>"
                                        data-email= "<?php echo $email ?>"
                                        data-currency="EUR"
                                        data-amount="<?php echo $total . '00' ?>"
                                        data-name="Eurogamer"
                                        data-description="Stripe Sales Example"
                                        data-image="images/logo.png"
                                        data-locale="auto">
                                    </script>
                                </form>
                                <?php
                            } else {
                                ?>
                            <form style="text-align: center">
                                <a href="#" class="login-button button">Login/Register</a>
                                <br>
                                <br>
                                <p style="font-weight: lighter;">Please login or register to proceed with the payment</p>
                            </form>

    <?php
}
?>
                            </p>
                        </div> <!-- .cart-total -->









































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

</html>
<script>
                                        $(document).ready(function (data) {
                                            $('.add_to_cart').click(function () {
                                                var product_id = $(this).attr("id");
                                                var product_name = $('#name' + product_id).val();
                                                var product_price = $('#price' + product_id).val();
                                                var product_quantity = $('#quantity' + product_id).val();
                                                var action = "add";
                                                if (product_quantity > 0)
                                                {
                                                    $.ajax({
                                                        url: "action.php",
                                                        method: "POST",
                                                        dataType: "json",
                                                        data: {
                                                            product_id: product_id,
                                                            product_name: product_name,
                                                            product_price: product_price,
                                                            product_quantity: product_quantity,
                                                            action: action
                                                        },
                                                        success: function (data)
                                                        {
                                                            $('#order_table').html(data.order_table);
                                                            $('.badge').text(data.cart_item);
                                                            alert("Product has been Added into Cart");
                                                        }
                                                    });
                                                } else
                                                {
                                                    alert("Please Enter Number of Quantity")
                                                }
                                            });
                                            $(document).on('click', '.delete', function () {
                                                var product_id = $(this).attr("id");
                                                var action = "remove";
                                                if (confirm("Are you sure you want to remove this product?"))
                                                {
                                                    $.ajax({
                                                        url: "action.php",
                                                        method: "POST",
                                                        dataType: "json",
                                                        data: {product_id: product_id, action: action},
                                                        success: function (data) {
                                                            $('#order_table').html(data.order_table);
                                                            $('.badge').text(data.cart_item);
                                                        }
                                                    });
                                                } else
                                                {
                                                    return false;
                                                }
                                            });
                                            $(document).on('keyup', '.quantity', function () {
                                                var product_id = $(this).data("product_id");
                                                var quantity = $(this).val();
                                                var action = "quantity_change";
                                                if (quantity != '')
                                                {
                                                    $.ajax({
                                                        url: "action.php",
                                                        method: "POST",
                                                        dataType: "json",
                                                        data: {product_id: product_id, quantity: quantity, action: action},
                                                        success: function (data) {
                                                            $('#order_table').html(data.order_table);
                                                        }
                                                    });
                                                }
                                            });
                                        });
</script>
