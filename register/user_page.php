<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
    header('location:login_form.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user page</title>

    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <h3>hi, <span>user</span></h3>
            <h1>Welcome to FutionLK <span><?php  echo $_SESSION['user_name'] ?></span></h1>
            <p>this is a user page</p>
            <a href="login_form.php" class="btn">login</a>
            <a href="register_form.php" class="btn">register</a>
            <a href="logout.php" class="btn">logout</a>
            
        </div>
    </div>
</body>
</html>