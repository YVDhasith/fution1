<?php
    session_start();
    $db_name = "shopping";
    $connection = mysqli_connect("localhost","root","14631",$db_name);

    if(isset($_POST["add"])){
        if(isset($_SESSION["shopping_cart"])){
            $item_array_id = array_column($_SESSION["shopping_cart"],"product_id");
            if(!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'product_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'product_quantity' => $_POST["quantity"],
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
                echo '<script>window.location="shop.php"</script>';
            }else{
                echo '<script>alert("Product is already in  the cart")</script>';
                echo '<script>window.location="shop.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'product_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'product_quantity' => $_POST["quantity"],
            );
            $_SESSION["shopping_cart"][0] = $item_array;
        }
    }

    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["shopping_cart"] as $keys => $value){
                if($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["shopping_cart"][$keys]);
                    echo '<script>alert("Product has been removed")</script>';
                    echo '<script>window.location="shop.php"</script>';
                }
            }
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUTION</title>
    <link rel="stylesheet" href="style.css">  
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</head>
<body>
    <section id="header">
        <a href="#"><img src="img/logo2.png" class="logo" width="90" height="90" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a href="homepage.html">Home</a></li>
                <li><a class="active" href="shop.html">Shop</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li id="lg-bag"><a href="cart.html"><img src="img/shopping-cart.png" class="logo" width="28" height="28" alt=""></a></li>
                <li><a href="http://localhost/SLIIT_Fution/register/login_form.php"><img src="img/login_7.png" class="logo" width="48" height="48" alt=""></a></li>
                <a href="#" id="close"><i><img src="img/icon/close3.png" class="logo" width="30" height="30" alt=""></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="contact.html"><img src="img/shopping-cart.png" class="logo" width="30" height="30" alt=""></a>
            <i id="bar"><img src="img/icon/hm3.png" class="logo" width="30" height="30" alt=""></i>
        </div>
    </section>
    
    <section id="page-header">
        <h2>STORE</h2>
    </section>

    <section id="cato" class="section-p1">
        <h2>STORE</h2>
        <p>Laptops & PC Components</p>               
       
    </section>
    <style>
        .product{
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
            flex-wrap: wrap;
            width: 19%;
            min-width: 250px;
            padding: 10px 12px;
            border: 2px solid #cce7d0;
            border-radius: 25px;
            cursor: pointer;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.02);
            margin: 15px 0;
            transition: 0.2s ease;
            
        }
        .product:hover {
            box-shadow: 2px 2px 2px 2px #088178;
        }
        .product .img{
            width: 100%;
            border-radius: 20px ;
        }

        table,th,tr{
              text-align: center;
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
    </style>
        <div class="container" style="width: 65%">
        <h2>Shopping Cart</h2>
        <?php
            $query = "select * from product order by id asc";
            $result = mysqli_query($connection,$query);
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                    ?>
                    <div class="col-md-3" style="float: left;">
                        <form method="post" action="shop.php?action=add&id=<?php echo $row["id"];?>">
                            <div class="product">
                                <img src="<?php echo $row["image"];?>" width="190px" height="200px" class="img-responsive">
                                <h5 class="text-info"><?php echo $row["description"];?></h5>
                                <h5 class="text-danger"><?php echo $row["price"];?></h5>
                                <input type="text" name="quantity" class="form-control" value="1">
                                <input type="hidden" name="hidden_name" value="<?php echo $row["description"];?>">
                                <input type="hidden" name="hidden_price" value="<?php echo $row["price"];?>">
                                <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to cart">
                            </div>
                        </form>
                    </div>
        <?php
                }
            }
        ?>

        <div style="clear: both"></div>
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
            <tr>
                <th width="30%">Product Description</th>
                <th width="10%">Quantity</th>
                <th width="13%">Price Details</th>
                <th width="10%">Total Price</th>
                <th width="17%">Remove Item</th>
            </tr>
            <?php
                if(!empty($_SESSION["shopping_cart"])){
                    $total=0;
                    foreach($_SESSION["shopping_cart"] as $key => $value){
                    ?>
                <tr>
                        <td><?php echo $value["product_name"];?></td>
                        <td><?php echo $value["product_quantity"];?></td>
                        <td><?php echo $value["product_price"];?></td>
                        <td><?php echo number_format($value["product_quantity"]*$value["product_price"],2);?></td>
                        <td><a href="shop.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>
                </tr>
                <?php
                    $total = $total + ($value["product_quantity"]*$value["product_price"]);
                    }
                ?>
                <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right"><?php echo number_format($total,2);?></td>
                        <td></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>

    </div>





    <section id="newupdate"  class="section-p1 section-m1" >
        <div class="newstext">
            <h4>Sign Up For Newupdates </h4>
            <p>Get E-mail updates about our latest products and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <a href="http://localhost/SLIIT_Fution/register/login_form.php"><button class="normal">Sign Up</button></a>
        </div>
    </section>

    <footer id="ft" class="section-p1">
        <div class="col">
            <img class="logo" src="img/logo2.png" class="logo" width="90" height="90" alt="">
            <h4>Contact</h4>
            <p><strong>Address: </strong>55/A Bandaranaike Mawatha, Ratnapura</p>
            <p><strong>Phone: </strong>+9470 196 6688 /+9477 196 6677 </p>
            <p><strong>Hours: </strong> 9:30 - 18:30, Mon - Sat</p>
            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i><img src="img/icon/f.png" class="logo" width="20" height="20" alt=""></i>
                    <i><img src="img/icon/i.png" class="logo" width="20" height="20" alt=""></i>
                    <i><img src="img/icon/p.png" class="logo" width="20" height="20" alt=""></i>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <div class="col pay"> 
            <h4>Payment</h4>
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png" alt="">
        </div>

        <div class="copyright">
            <p>&copy;Designed & developed by Kalana_Dhasith</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>