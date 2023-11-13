<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the home page after logout
header("Location: ../../index.php"); // Modify the path if needed
exit();
?>
