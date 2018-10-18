<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "d00123456");
if (isset($_POST["add_to_cart"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="products.php"</script>';
        }
    } else {
        $item_array = array(
            'item_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
            }
        }
    }
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
                        <div class="filter-bar">
                            <div class="filter">
                                <span>
                                    <label>Sort by:</label>
                                    <select name="#">
                                        <option value="#">Popularity</option>
                                        <option value="#">Highest Rating</option>
                                        <option value="#">Lowest price</option>
                                    </select>
                                </span>
                                <span>
                                    <label>Genre</label>
                                    <select name="#">
                                        <option value="#">Show All</option>
                                        <option value="#">Action</option>
                                        <option value="#">Racing</option>
                                        <option value="#">Strategy</option>
                                    </select>
                                </span>
                                <span>
                                    <label>Show:</label>
                                    <select name="#">
                                        <option value="#">8</option>
                                        <option value="#">16</option>
                                        <option value="#">24</option>
                                    </select>
                                </span>
                            </div> <!-- .filter -->

                            <div class="pagination">
                                <a href="#" class="page-number"><i class="fa fa-angle-left"></i></a>
                                <span class="page-number current">1</span>
                                <a href="#" class="page-number">2</a>
                                <a href="#" class="page-number">3</a>
                                <a href="#" class="page-number">...</a>
                                <a href="#" class="page-number">12</a>
                                <a href="#" class="page-number"><i class="fa fa-angle-right"></i></a>
                            </div> <!-- .pagination -->
                        </div> <!-- .filter-bar -->
                        <div class="product-list">
                            <?php
                            $query = "SELECT * FROM tbl_product ORDER BY id ASC";
                            $result = mysqli_query($connect, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    ?>  

                            <form method="post" action="products.php?action=add&id=<?php echo $row["id"]; ?>"> 
                                        <div class="product">
                                            <div class="inner-product">
                                                <div class="figure-image">
                                                    <a href="single.php"><img src="<?php echo $row["image"]; ?>" class="img-responsive" /></a>
                                                </div>
                                                <h3 class="text-info" style="color: black; font-weight: bolder;"><?php echo $row["name"]; ?></h3>
                                                <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                                <h3 class="text-danger" style="color: black; font-weight: bolder;">$ <?php echo $row["price"]; ?></h3>  
                                                <p><input type="text" name="quantity" style="width: 100%;" class="form-control" value="1" /></p>
                                                
                                                <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                                                <input type="submit" name="add_to_cart" style="width: 100%;" value="Add to Cart" />
<!--                                                <a type="submit" name="add_to_cart" class="button">Add to cart</a>-->
<!--                                                <a href="#" class="button muted">Read Details</a>-->
                                            </div>
                                        </div> 
                                    </form>

                                    <?php
                                }
                            }
                            ?>  
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                         
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>$ <?php echo $values["item_price"]; ?></td>  
                               <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="products.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                












<!--                        <div class="product-list">
                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="single.php"><img src="dummy/game-1.jpg" alt="Game 1"></a>
                                    </div>
                                    <h3 class="product-title"><a href="#">Alpha Protocol</a></h3>
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                    <a href="#" class="button">Add to cart</a>
                                    <a href="#" class="button muted">Read Details</a>
                                </div>
                            </div>  .product 

                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="single.php"><img src="dummy/game-2.jpg" alt="Game 2"></a>
                                    </div>
                                    <h3 class="product-title"><a href="#">Grand Theft Auto V</a></h3>
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                    <a href="#" class="button">Add to cart</a>
                                    <a href="#" class="button muted">Read Details</a>
                                </div>
                            </div>  .product 

                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="single.php"><img src="dummy/game-3.jpg" alt="Game 3"></a>
                                    </div>
                                    <h3 class="product-title"><a href="#">Need for Speed rivals</a></h3>
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                    <a href="#" class="button">Add to cart</a>
                                    <a href="#" class="button muted">Read Details</a>
                                </div>
                            </div>  .product 

                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="single.php"><img src="dummy/game-4.jpg" alt="Game 4"></a>
                                    </div>
                                    <h3 class="product-title"><a href="#">Big game hunter</a></h3>
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                    <a href="#" class="button">Add to cart</a>
                                    <a href="#" class="button muted">Read Details</a>
                                </div>
                            </div>  .product 

                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="single.php"><img src="dummy/game-5.jpg" alt="Game 1"></a>
                                    </div>
                                    <h3 class="product-title"><a href="#">Watch Dogs</a></h3>
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                    <a href="#" class="button">Add to cart</a>
                                    <a href="#" class="button muted">Read Details</a>
                                </div>
                            </div>  .product 


                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="single.php"><img src="dummy/game-6.jpg" alt="Game 2"></a>
                                    </div>
                                    <h3 class="product-title"><a href="#">Mortal Kombat X</a></h3>
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                    <a href="#" class="button">Add to cart</a>
                                    <a href="#" class="button muted">Read Details</a>
                                </div>
                            </div>  .product 


                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="single.php"><img src="dummy/game-7.jpg" alt="Game 3"></a>
                                    </div>
                                    <h3 class="product-title"><a href="#">Metal Gear Solid V</a></h3>
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                    <a href="#" class="button">Add to cart</a>
                                    <a href="#" class="button muted">Read Details</a>
                                </div>
                            </div>  .product 


                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="single.php"><img src="dummy/game-8.jpg" alt="Game 4"></a>
                                    </div>
                                    <h3 class="product-title"><a href="#">Nascar '14</a></h3>
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                    <a href="#" class="button">Add to cart</a>
                                    <a href="#" class="button muted">Read Details</a>
                                </div>
                            </div>  .product 

                        </div>  .product-list -->

                        <div class="pagination-bar">
                            <div class="pagination">
                                <a href="#" class="page-number"><i class="fa fa-angle-left"></i></a>
                                <span class="page-number current">1</span>
                                <a href="#" class="page-number">2</a>
                                <a href="#" class="page-number">3</a>
                                <a href="#" class="page-number">...</a>
                                <a href="#" class="page-number">12</a>
                                <a href="#" class="page-number"><i class="fa fa-angle-right"></i></a>
                            </div> <!-- .pagination -->
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

</html>

















































<tr>
                                    <td class="product-name">
                                        <div class="product-thumbnail">
                                            <img src="dummy/cart-thumb-1.jpg" alt="">
                                        </div>
                                        <div class="product-detail">
                                            <h3 class="product-title">GTA 5</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure nobis architecto dolorum, alias laborum sit odit, saepe expedita similique eius enim quasi obcaecati voluptates, autem eveniet ratione veniam omnis modi.</p>
                                        </div>
                                    </td>
                                    <td class="product-price">$150.00</td>
                                    <td class="product-qty">
                                        <select name="#">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </td>
                                    <td class="product-total">$150.00</td>
                                    <td class="action"><a href="#"><i class="fa fa-times"></i></a></td>
                                </tr>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                