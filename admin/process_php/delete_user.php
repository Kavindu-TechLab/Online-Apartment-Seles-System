<?php
session_start();

// Include your database connection file
include('../process_php/db_connection.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if the user_id is set and not empty
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Delete user listings first (assuming the user_id is a foreign key in the listings table)
    $sqlDeleteListings = "DELETE FROM listing_details WHERE user_id = $user_id";

    if ($conn->query($sqlDeleteListings) === TRUE) {
        // Now delete the user
        $sqlDeleteUser = "DELETE FROM users WHERE user_id = $user_id";

        if ($conn->query($sqlDeleteUser) === TRUE) {
            // Redirect to the page with the users after successful deletion
            header("Location: ../view_users.php");
            exit();
        } else {
            echo "Error deleting user: " . $conn->error;
        }
    } else {
        echo "Error deleting user listings: " . $conn->error;
    }
}

$conn->close();
?>
