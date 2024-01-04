<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';

session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $birthdate = $_POST["birthdate"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
    $profilePhoto = $_FILES["profilePhoto"]["name"]; // Retrieve the profile photo file name

    // Upload profile photo to the server
    $targetDirectory = "uploads/profile_photos/";
    $targetFilePath = $targetDirectory . basename($profilePhoto);
    move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetFilePath);

    // Check if the email is already registered
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email already registered, set an error message
        $_SESSION["error_message"] = "Your Registration was unsuccessful. Email is already registered.";

        // Redirect back to the registration page with an error
        header("Location: ../register.php");
        exit();
    } elseif ($password != $confirmPassword) {
        // Passwords do not match, set an error message
        $_SESSION["error_message"] = "Your Registration was unsuccessful. Password and confirm password do not match.";

        // Redirect back to the registration page with an error
        header("Location: ../register.php");
        exit();
    } else {
        // Insert data into the database with email verification status as false
        $verificationToken = md5(uniqid(rand(), true));
        $sql = "INSERT INTO users (first_name, last_name, birthdate, email, password, profile_photo, email_verified, verification_token)
        VALUES ('$firstName', '$lastName', '$birthdate', '$email', '$hashedPassword', '$profilePhoto', FALSE, '$verificationToken')";

        if ($conn->query($sql) === TRUE) {
            // Send email verification link
            $verificationLink = "http://localhost/Online-Apartment-Seles-System/process_php/verify_email.php?email=$email&token=$verificationToken";

            // Send email verification link using PHPMailer
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
                $mail->Subject = 'Email Verification - ApartMint';
                $mail->Body = "Click on the link below to verify your email:<br><a href='$verificationLink'>$verificationLink</a>";

                $mail->send();
                header("Location: ../wait_verify_email.php");
            } catch (Exception $e) {
                echo "Error sending email. Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    // If the form is not submitted, redirect back to the registration page
    header("Location: ../register.php");
    exit();
}

$conn->close();
?>
