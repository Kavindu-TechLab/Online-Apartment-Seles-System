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
    <title>Register</title>
</head>

<body>
    <!-- Include the navigation bar -->
    <?php include('navbar.php'); ?>

    <div class="container">
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
            <h1>Welcome To Apartmint......!</h1>
            <p>Join the Minty Side of Apartment Hunting with ApartMint.</p>

            <!-- Display error message if set in the session -->
            <?php
                if (isset($_SESSION["error_message"])) {
                    echo '<div class="error-message">' . $_SESSION["error_message"] . '</div>';
                    unset($_SESSION["error_message"]); // Clear the error message from session
                }
            ?>

            <!-- Registration Form -->
            <form action="process_php/process_registration.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="half">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" required>
                    </div>
                    <div class="half">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" required>
                    </div>
                </div>
                <div class="form-row">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                </div>
                <div class="form-row">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-row">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-row">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>
                <div class="form-row">
                    <label for="profilePhoto">Profile Photo</label>
                    <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*">
                </div>
                <button type="submit" class="register-submit">Register</button>
            </form>
        </div>
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>

</body>

</html>
