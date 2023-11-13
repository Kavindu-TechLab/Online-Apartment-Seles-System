<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listingId = $_POST["listing_id"];
    $action = $_POST["action"];

    // Update the listing_details table based on the action
    if ($action === "approve") {
        $updateSql = "UPDATE listing_details SET approval_status = 'Approved' WHERE id = '$listingId'";
    } elseif ($action === "reject") {
        $updateSql = "UPDATE listing_details SET approval_status = 'Rejected' WHERE id = '$listingId'";
    }

    if ($conn->query($updateSql) === TRUE) {
        // Update successful, you can redirect or perform additional actions if needed
        header("Location: ../view_pendingListings.php");
    } else {
        // Update failed, handle the error as needed
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // If the request method is not POST, redirect back to the previous page or handle accordingly
    header("Location: ../view_pendingListings.php");
}
?>
