<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include('db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deactivate-account"])) {
    $user_id = $_SESSION["user_id"];

    // Start a transaction
    $conn->begin_transaction();

    // Delete user records from the listing_details table
    $deleteListingSQL = "DELETE FROM listing_details WHERE user_id='$user_id'";
    if ($conn->query($deleteListingSQL) === TRUE) {
        // Delete user record from the users table
        $deleteUserSQL = "DELETE FROM users WHERE user_id='$user_id'";
        if ($conn->query($deleteUserSQL) === TRUE) {
            // Commit the transaction if both deletions are successful
            $conn->commit();
            // Log out the user and redirect to the login page
            session_unset();
            session_destroy();
            header("Location: ../login.php");
            exit();
        } else {
            // Rollback the transaction if user deletion fails
            $conn->rollback();
            $_SESSION["deactivate_account_error"] = "Error deactivating account. Please try again later.";
            header("Location: ../myAccount.php");
            exit();
        }
    } else {
        // Rollback the transaction if listing deletion fails
        $conn->rollback();
        $_SESSION["deactivate_account_error"] = "Error deactivating account. Please try again later.";
        header("Location: ../myAccount.php");
        exit();
    }
}

$conn->close();
?>
