<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/style_register.css">
    <title>Register</title>
    <style>
        .submit {
            text-align:center;
        }
     
    </style>
</head>
<body>
    <!-- Include the navigation bar -->
    <?php include('navbar.php'); ?>

    <div class="submit">
    <img style="margin-top: 50px;" src="images/email.png" height="120px" width="120px">
    
    <h1 style="color: rgb(242, 138, 10);">Login to your email account and click the verify link.</h1>
    <h3 style="color: red; margin-bottom:100px;">You can't log in to the system if you don't verify the email.</h3>
    
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>
   
</body>
</html>