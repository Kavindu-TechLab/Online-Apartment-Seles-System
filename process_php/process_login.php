<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the user is an admin
    $admin_sql = "SELECT * FROM admins WHERE email = '$email'";
    $admin_result = $conn->query($admin_sql);

    if ($admin_result === false) {
        die("Error executing admin query: " . $conn->error);
    }

    if ($admin_result->num_rows == 1) {
        $admin_row = $admin_result->fetch_assoc();
        if (password_verify($password, $admin_row["password"])) {
            // Admin found, create session variables and redirect to admin dashboard
            $_SESSION["admin_id"] = $admin_row["admin_id"];
            $_SESSION["admin_email"] = $admin_row["email"];
            $_SESSION["admin_name"] = $admin_row["first_name"] . " " . $admin_row["last_name"];
            $_SESSION["admin_profile_photo"] = $admin_row["profile_photo"];

            header("Location: ../admin/admin_dashboard.php");
            exit();
        }
    }

    // If not an admin, check regular users
    $user_sql = "SELECT * FROM users WHERE email = '$email'";
    $user_result = $conn->query($user_sql);

    if ($user_result === false) {
        die("Error executing user query: " . $conn->error);
    }

    if ($user_result->num_rows == 1) {
        $user_row = $user_result->fetch_assoc();
        if (password_verify($password, $user_row["password"])) {
            // Check if the email is verified
            if ($user_row["email_verified"] == 1) {
                // Regular user found, create session variables and redirect to home page
                $_SESSION["user_id"] = $user_row["user_id"];
                $_SESSION["user_email"] = $user_row["email"];
                $_SESSION["user_name"] = $user_row["first_name"] . " " . $user_row["last_name"];
                $_SESSION["user_profile_photo"] = $user_row["profile_photo"];

                header("Location: ../index.php");
                exit();
            } else {
                // Email not verified, redirect to wait_verify_email.php
                header("Location: ../wait_verify_email.php");
                exit();
            }
        }
    }

    // If no match is found, redirect back to the login page with an error message
    $_SESSION["login_error"] = "Email or Password doesn't match!";
    header("Location: ../login.php");
    exit();

    $conn->close();
} else {
    // If the request method is not POST, redirect back to the login page
    header("Location: ../login.php");
}
?>
