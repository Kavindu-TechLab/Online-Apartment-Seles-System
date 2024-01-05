<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $token = $_POST["token"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Check if the new password and confirm password match
    if ($newPassword != $confirmPassword) {
        // Set an error message and redirect back to the reset password page
        $_SESSION["reset_password_error"] = "New password and confirm password do not match.";
        header("Location: ../reset_password.php?email=$email&token=$token");
        exit();
    }

    // Check if the email and token match in the database
    $user_sql = "SELECT * FROM users WHERE email = '$email' AND reset_token = '$token'";
    $user_result = $conn->query($user_sql);

    if ($user_result === false) {
        die("Error executing user query: " . $conn->error);
    }

    if ($user_result->num_rows == 1) {
        // Reset the password and remove the reset token
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $update_password_sql = "UPDATE users SET password = '$hashedPassword', reset_token = NULL WHERE email = '$email'";
        $conn->query($update_password_sql);

        $_SESSION["reset_password_success"] = "Password changed successfully!";
    } else {
        // Invalid email or token, display an error message
        $_SESSION["reset_password_error"] = "Invalid email or token.";
    }

    // Redirect back to the reset password page
    header("Location: ../reset_password.php?email=$email&token=$token");
    exit();

    $conn->close();
} else {
    // If the request method is not POST, redirect back to the reset password page
    header("Location: ../reset_password.php");
    exit();
}
?>
