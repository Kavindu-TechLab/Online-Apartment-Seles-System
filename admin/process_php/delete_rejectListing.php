<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include('db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if listing_id is set
    if (isset($_POST['listing_id'])) {
        $listing_id = $_POST['listing_id'];

        // Perform the delete operation
        $sql = "DELETE FROM listing_details WHERE id = $listing_id";
        if ($conn->query($sql) === TRUE) {
            // Redirect to the page with the listings after successful deletion
            header("Location: ../view_rejected_properties.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

$conn->close();
?>