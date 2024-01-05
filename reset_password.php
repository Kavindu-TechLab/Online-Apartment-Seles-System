<?php
session_start();
include('process_php/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_GET["email"];
    $token = $_GET["token"];

    // Check if the email and token match in the database
    $user_sql = "SELECT * FROM users WHERE email = '$email' AND reset_token = '$token'";
    $user_result = $conn->query($user_sql);

    if ($user_result === false) {
        die("Error executing user query: " . $conn->error);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link rel="stylesheet" type="text/css" href="style/style_register.css">
    <title>Reset Password</title>
</head>

<body>
    <!-- Include the navigation bar -->
    <?php include('navbar.php'); ?>

    <div class="container" style="margin-top: 20px; margin-bottom: 60px">
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

            <div class="forgot-password-section">
                <h2 style="color: rgb(242, 138, 10);">Account Recovery</h2>
                <form action="process_php/process_reset_password.php" method="post">
                    <div class="form-row">
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <label for="new_password">New Password</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>
                    
                    <div class="form-row">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <?php
                    if (isset($_SESSION["reset_password_success"])) {
                        echo '<div class="success-message">' . $_SESSION["reset_password_success"] . '</div>';
                        unset($_SESSION["reset_password_success"]);
                    } elseif (isset($_SESSION["reset_password_error"])) {
                        echo '<div class="error-message">' . $_SESSION["reset_password_error"] . '</div>';
                        unset($_SESSION["reset_password_error"]); 
                    }
                    ?>

                    <button type="submit" class="register-submit" value="Reset Password">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>

</body>

</html>
<?php
    }
?>
