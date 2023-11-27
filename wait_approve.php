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
    <img style="margin-top: 50px;" src="images/apply.png" height="120px" width="120px">
    
    <h1 style="color: rgb(242, 138, 10);">Your listing has been submitted.</h1>
    <h3 style="color: rgba(84, 61, 33, 1);">Our team reviewing your listing and it will be published to the Apartmint.com network soon!!!</h3>
    
    <a href="user_dashboard.php"><button style="margin-bottom: 100px; margin-top: 50px;" class="register-submit" type="button">Continue to properties</button></a>
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>
   
</body>
</html>