<?php
session_start();
include('db_connection.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Retrieve user data from the database based on the provided email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, verify the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, create session variables and redirect to dashboard or home page
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["user_email"] = $row["email"];
            $_SESSION["user_name"] = $row["first_name"]; // Assuming the user's name is stored in the 'first_name' column
            $_SESSION["user_profile_photo"] = $row["profile_photo"]; // Assuming the profile photo file name is stored in the 'profile_photo' column
            header("Location: ../index.php");
        } else {
            // Incorrect password, redirect back to the login page with an error message
            $_SESSION["login_error"] = "Email or Password doesn't match!";
            header("Location: ../login.php"); // Redirect to the login page
        }
    } else {
        // User not found, redirect back to the login page with an error message
        $_SESSION["login_error"] = "Email or Password doesn't match!";
        header("Location: ../login.php"); // Redirect to the login page
    }
    
    $conn->close();
} else {
    // If the request method is not POST, redirect back to the login page
    header("Location: ../login.php"); // Redirect to the login page
}
?>



