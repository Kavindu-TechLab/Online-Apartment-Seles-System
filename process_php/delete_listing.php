<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

include('db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the listing ID is provided in the URL
if (isset($_GET['id'])) {
    $listing_id = $_GET['id'];

    // Verify that the listing belongs to the logged-in user
    $user_id = $_SESSION["user_id"];
    $verify_sql = "SELECT * FROM listing_details WHERE id = $listing_id AND user_id = $user_id";
    $verify_result = $conn->query($verify_sql);

    if ($verify_result->num_rows > 0) {
        // Listing belongs to the user, proceed with deletion
        $delete_sql = "DELETE FROM listing_details WHERE id = $listing_id";
        if ($conn->query($delete_sql) === TRUE) {
            // Deletion successful, redirect to myListing.php
            header("Location: ../user_dashboard.php");
            exit();
        } else {
            echo "Error deleting listing: " . $conn->error;
        }
    } else {
        echo "Unauthorized access to this listing.";
    }
} else {
    echo "Listing ID not provided.";
}

$conn->close();
?>
