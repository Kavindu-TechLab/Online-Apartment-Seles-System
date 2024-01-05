<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';

session_start();
include('db_connection.php');
require 'vendor/autoload.php'; // Include PHPMailer autoload

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Check if the email exists in the database
    $user_sql = "SELECT * FROM users WHERE email = '$email'";
    $user_result = $conn->query($user_sql);

    if ($user_result === false) {
        die("Error executing user query: " . $conn->error);
    }

    if ($user_result->num_rows == 1) {
        $user_row = $user_result->fetch_assoc();

        // Generate a verification token
        $verificationToken = md5(uniqid(rand(), true));

        // Store the verification token in the database
        $update_token_sql = "UPDATE users SET reset_token = '$verificationToken' WHERE email = '$email'";
        $conn->query($update_token_sql);

        // Send an email with the password reset link
        $resetLink = "http://localhost/Online-Apartment-Seles-System/reset_password.php?email=$email&token=$verificationToken";

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = "apartmintproperty@gmail.com";
            $mail->Password = 'uxlw qqzt xpox bccc';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('apartmintproperty@gmail.com', 'Apartmint');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset - ApartMint';
            $mail->Body = "Click on the link to reset your password: $resetLink";

            $mail->send();

            $_SESSION["reset_email_sent"] = true;
            $_SESSION["reset_email_success_message"] = "Password reset link sent successfully. Cheack Your email account inbox.";
        } catch (Exception $e) {
            $_SESSION["reset_email_error"] = "Error sending email. Please try again later.";
        }
    } else {
        // Email not found, display an error message
        $_SESSION["reset_email_error"] = "Email not found!";
    }

    // Redirect back to the forgot password page
    header("Location: ../forgot_password.php");
    exit();

    $conn->close();
} else {
    // If the request method is not POST, redirect back to the forgot password page
    header("Location: ../forgot_password.php");
    exit();
}
?>
