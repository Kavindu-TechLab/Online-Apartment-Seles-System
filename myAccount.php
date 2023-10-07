<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Ensure that code execution stops after the redirect
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>

    <h1>Welcome to Apartment Sales</h1>
    <!-- Your homepage content here -->

    <!-- Include the footer -->
    <?php include('footer.php'); ?>
</body>
</html>