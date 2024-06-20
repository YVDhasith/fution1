<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

    $row = mysqli_fetch_array($result);

    if($row['user_type']== 'admin'){
        $_SESSION['admin_name'] = $row['name'];
        header('location:admin_page.php');

    }elseif($row['user_type']== 'user'){
        $_SESSION['user_name'] = $row['name'];
        header('location:user_page.php');
    }
      
   }else{
        $error[] = 'incorrect email or password!';

   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="http://localhost/SLIIT_Fution/style.css">
</head>
<body>

<section id="header">
        <a href="#"><img src="img/logo2.png" class="logo" width="90" height="90" alt=""></a>

        <div>
            <ul id="navbar">
                <li><a href="http://localhost/SLIIT_Fution/homepage.html">Home</a></li>
                <li><a  href="http://localhost/SLIIT_Fution/shop.html">Shop</a></li>
                <li><a href="http://localhost/SLIIT_Fution/about.html">About</a></li>
                <li><a href="http://localhost/SLIIT_Fution/contact.html">Contact</a></li>
                <li id="lg-bag"><a href="http://localhost/SLIIT_Fution/cart.html"><img src="http://localhost/SLIIT_Fution/img/shopping-cart.png" class="logo" width="28" height="28" alt=""></a></li>
                <li><a class="active" href="login_form.php"><img src="http://localhost/SLIIT_Fution/img/login_7.png" class="logo" width="48" height="48" alt=""></a></li>
                <a href="#" id="close"><i><img src="http://localhost/SLIIT_Fution/img/icon/close3.png" class="logo" width="30" height="30" alt=""></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="contact.html"><img src="img/shopping-cart.png" class="logo" width="30" height="30" alt=""></a>
            <i id="bar"><img src="img/icon/hm3.png" class="logo" width="30" height="30" alt=""></i>
        </div>
    </section>
    
    <section id="page-header" class="about-headerC">
        <h2>Login</h2>
    </section>
    <section>

<div class="form-container">
    <form action="" method="post">
        <h3>login now</h3>
        <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="password" name="password" required placeholder="Enter your password">
        <input type="submit" name="submit" value="login now" class="form-btn">
        <p>don't have an account? <a href="register_form.php">register now</a></p><br>
    </form>
</div>




<footer id="ft" class="section-p1">
        <div class="col">
            <img class="logo" src="http://localhost/SLIIT_Fution/img/logo2.png" class="logo" width="90" height="90" alt="">
            <h4>Contact</h4>
            <p><strong>Address: </strong>55/A Bandaranaike Mawatha, Ratnapura</p>
            <p><strong>Phone: </strong>+9470 196 6688 /+9477 196 6677 </p>
            <p><strong>Hours: </strong> 9:30 - 18:30, Mon - Sat</p>
            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i><img src="http://localhost/SLIIT_Fution/img/icon/f.png" class="logo" width="20" height="20" alt=""></i>
                    <i><img src="http://localhost/SLIIT_Fution/img/icon/i.png" class="logo" width="20" height="20" alt=""></i>
                    <i><img src="http://localhost/SLIIT_Fution/img/icon/p.png" class="logo" width="20" height="20" alt=""></i>
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
            <img src="http://localhost/SLIIT_Fution/img/pay/pay.png" alt="">
        </div>

        <div class="copyright">
            <p>&copy;Designed & developed by Kalana_Dhasith</p>
        </div>
    </footer>

    <script src="http://localhost/SLIIT_Fution/script.js"></script>
    
</body>
</html>