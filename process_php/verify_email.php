<?php
session_start();
include('db_connection.php');

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Verify the email and token in the database
    $sql = "UPDATE users SET email_verified = TRUE WHERE email = '$email' AND verification_token = '$token'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["success_message"] = "Email verification successful. You can now log in.";
        header("Location: ../login.php");
    } else {
        $_SESSION["error_message"] = "Email verification failed.";
        header("Location: ../error.php");
    }
} else {
    $_SESSION["error_message"] = "Invalid email verification link.";
    header("Location: ../error.php");
}

$conn->close();
?>
