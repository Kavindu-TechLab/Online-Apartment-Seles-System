<?php
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
        $_SESSION["error_message"] = "Your Registration unsuccessful. Email is already registered.";

        // Redirect back to the registration page with an error
        header("Location: ../register.php");
        exit();
    } elseif ($password != $confirmPassword) {
        // Passwords do not match, set an error message
        $_SESSION["error_message"] = "Your Registration unsuccessful. Password and confirm password do not match.";

        // Redirect back to the registration page with an error
        header("Location: ../register.php");
        exit();
    } else {
        // Insert data into the database
        $sql = "INSERT INTO users (first_name, last_name, birthdate, email, password, profile_photo)
        VALUES ('$firstName', '$lastName', '$birthdate', '$email', '$hashedPassword', '$profilePhoto')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../registration_successful.php");
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
