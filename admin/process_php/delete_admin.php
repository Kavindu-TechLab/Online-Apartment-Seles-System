<?php
session_start();

// Include your database connection file
include('db_connection.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if the admin_id is set and not empty
if (isset($_POST['admin_id']) && !empty($_POST['admin_id'])) {
    $admin_id = $_POST['admin_id'];

    // Delete the admin
    $sqlDeleteAdmin = "DELETE FROM admins WHERE admin_id = $admin_id";

    if ($conn->query($sqlDeleteAdmin) === TRUE) {
        // Redirect to the page with the admins after successful deletion
        header("Location: ../view_admins.php");
        exit();
    } else {
        echo "Error deleting admin: " . $conn->error;
    }
}

$conn->close();
?>
