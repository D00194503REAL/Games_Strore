<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "D00194503");
require_once ("header.php");
?>  

                        












                        <div id="myTable" class="product-list">
                            <?php
                            $query = "SELECT * FROM tbl_product ORDER BY id ASC";
                            $result = mysqli_query($connect, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                ?>  
                                <div class="product">
                                    <div class="inner-product">
                                        <div class="figure-image">
                                            <a href="single.php"><img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /></a>
                                        </div>
                                        <h3 class="text-info" style="color: black; font-weight: bolder;"><?php echo $row["name"]; ?></h3>
                                        <p>Lorem ipsum dolor sit consectetur adipiscing elit do eiusmod tempor...</p>
                                        <h3 class="text-danger" style="color: black; font-weight: bolder;">$ <?php echo $row["price"]; ?></h3>  
                                        <p><input type="number" name="quantity" style="width: 100%;" id="quantity<?php echo $row["id"]; ?>" class="form-control" value="1" /></p>

                                        <input type="hidden" name="hidden_name" id="name<?php echo $row["id"]; ?>" value="<?php echo $row["name"]; ?>" />  
                                        <input type="hidden" name="hidden_price" id="price<?php echo $row["id"]; ?>" value="<?php echo $row["price"]; ?>" />  
                                        <input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" style="margin-top:5px; width: 100%;" class="button btn-warning form-control add_to_cart" value="Add to Cart" />
                                        <!--                                                <a type="submit" name="add_to_cart" class="button">Add to cart</a>-->
                                        <!--                                                <a href="#" class="button muted">Read Details</a>-->
                                    </div>
                                </div> 
                            <?php
                                }
                            ?>  
                        </div> 
                    </div>  
                </div>













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

                
        <?php require_once ("footer.php"); ?>
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
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("div");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("h3")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>