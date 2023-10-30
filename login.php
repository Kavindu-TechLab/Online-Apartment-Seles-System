<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/style_register.css">
    <title>Login</title>
</head>

<body>
    <!-- Include the navigation bar -->
    <?php include('navbar.php'); ?>

    <div class="container" style="margin-top: 60px; margin-bottom: 60px">
        <div class="left-section">
            <div class="row">
                <img src="images/0c8bc5136709ff47018eaaa80e74149e.jpg" alt="Image 1">
                <img src="images/bb164a76f720b87251168fe46fb8f4c6.jpg" alt="Image 2">
                <img src="images/d42c557d39ac3b6190d56ae59dbc8e72.jpg" alt="Image 3">
                <img src="images/3b5c5a08925e964fcc4d90183843ed68.jpg" alt="Image 4">
            </div>
        </div>
        
        <div class="right-section">
            <!-- Logo and Title -->
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
            </div>
            <h1 style="margin-bottom: 20px;">Welcome To Apartmint......!</h1>

            

            <!-- Login Form -->
            <form action="process_php/process_login.php" method="post" >
                <div class="form-row">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-row">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

            <!-- Display error message here -->
            <?php
            if (isset($_SESSION["login_error"])) {
                echo '<div class="error-message"><br>' . $_SESSION["login_error"] . '</div>';
                unset($_SESSION["login_error"]); // Remove the session variable after displaying the message
            }
            ?>

            
                <button type="submit" class="register-submit" value="Login">Login</button>
            </form>
        </div>
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>

</body>

</html>
