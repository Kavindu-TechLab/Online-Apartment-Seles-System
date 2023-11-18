<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Ensure that code execution stops after the redirect
}

include('process_php/db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data from the "users" table based on user_id
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userName = $_SESSION["user_name"];
    $truncatedName = (strlen($userName) > 21) ? substr($userName, 0, 21) . '...' : $userName;
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $birthdate = $row["birthdate"];
    $email = $row["email"];
    $password = $row["password"];

} else {
    echo "User not found";
}

// Count the number of approved properties for the user
$sqlApprovedProperties = "SELECT COUNT(*) AS approvedCount FROM listing_details WHERE user_id = $user_id AND approval_status = 'Approved'";
$resultApprovedProperties = $conn->query($sqlApprovedProperties);

// Check for errors in the query
if ($resultApprovedProperties === false) {
    die("Error in SQL query: " . $conn->error);
}

$approvedCount = ($resultApprovedProperties->num_rows > 0) ? $resultApprovedProperties->fetch_assoc()['approvedCount'] : 0;

// Count the number of pending properties for the user
$sqlPendingProperties = "SELECT COUNT(*) AS pendingCount FROM listing_details WHERE user_id = $user_id AND approval_status = 'Pending'";
$resultPendingProperties = $conn->query($sqlPendingProperties);

// Check for errors in the query
if ($resultPendingProperties === false) {
    die("Error in SQL query: " . $conn->error);
}

$pendingCount = ($resultPendingProperties->num_rows > 0) ? $resultPendingProperties->fetch_assoc()['pendingCount'] : 0;

// Count the number of rejected properties for the user
$sqlRejectedProperties = "SELECT COUNT(*) AS rejectedCount FROM listing_details WHERE user_id = $user_id AND approval_status = 'Rejected'";
$resultRejectedProperties = $conn->query($sqlRejectedProperties);

// Check for errors in the query
if ($resultRejectedProperties === false) {
    die("Error in SQL query: " . $conn->error);
}

$rejectedCount = ($resultRejectedProperties->num_rows > 0) ? $resultRejectedProperties->fetch_assoc()['rejectedCount'] : 0;

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
<title>My Listings</title>
    <link rel="stylesheet" type="text/css" href="style/style_myAccount.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img class="profile-photo" src="process_php/uploads/profile_photos/<?php echo $_SESSION["user_profile_photo"]; ?>" alt="Profile Photo">
            <p class="full-name"><?php echo $truncatedName; ?></p>
            <ul>
                <a href="index.php"><li><button class="button">Home</button></li></a>
                <a href="user_dashboard.php"><li><button class="button">Dashboard</button></li></a>
                <a href="myAccount.php"><li><button class="button">Personal Details</button></li></a>
                <a href="process_php/process_logout.php"><li><button style="margin-bottom: 400px;" class="button">Log Out</button></li></a>
            </ul>
        </div>
        <div class="right-section">
            <a class="logo1" href="index.php"><img src="images/logo.png" alt="Logo"></a>
            <h1 class="main-title">User Dashboard</h1>
            <hr style="width: 100%; border: 2px #F28A0A solid">

            <div style="margin-bottom: 100px; margin-top: 60px;" class="admin-dashboard">
                <div>
                    <!-- Box 2: Number of Approved Properties -->
                    <div class="dashboard-box">
                        <div class="box-number"><?php echo $approvedCount; ?></div>
                        <div class="box-title">Properties Approved</div>
                        <div class="box-button"><a href="view_approvedListings.php">View</a></div>
                    </div>
                </div>
                <div>
                    <!-- Box 3: Number of Pending Properties -->
                    <div class="dashboard-box">
                        <div class="box-number"><?php echo $pendingCount; ?></div>
                        <div class="box-title">Properties Pending</div>
                        <div class="box-button"><a href="view_pendingListings.php">View</a></div>
                    </div>
                </div>
                <div>
                    <!-- Box 4: Number of Rejected Properties -->
                    <div class="dashboard-box">
                        <div class="box-number"><?php echo $rejectedCount; ?></div>
                        <div class="box-title">Properties Rejected</div>
                        <div class="box-button"><a href="view_rejected_properties.php">View</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
