<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include your database connection file
include('db_connection.php');

// Check for a valid database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if feedback_id is set in the POST request
if (isset($_POST['feedback_web_id'])) {
    $feedback_id = $_POST['feedback_web_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM feedback_web WHERE feedback_web_id  = ?");
    $stmt->bind_param("i", $feedback_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the page where feedbacks are displayed
        header("Location: ../view_feedbacks.php");
        exit();
    } else {
        echo "Error deleting feedback: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
