<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include your database connection file
include('../process_php/db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve admin data from the "admins" table based on admin_id
$admin_id = $_SESSION["admin_id"];
$sql = "SELECT * FROM admins WHERE admin_id = $admin_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $adminName = $_SESSION["admin_name"];
    $truncatedName = (strlen($adminName) > 21) ? substr($adminName, 0, 21) . '...' : $adminName;
    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $birthdate = $row["birthdate"];
    $email = $row["email"];
    $password = $row["password"];

} else {
    echo "admin not found";
}

// Count the number of registered users
$sqlUsers = "SELECT COUNT(*) AS userCount FROM users";
$resultUsers = $conn->query($sqlUsers);

// Check for errors in the query
if ($resultUsers === false) {
    die("Error in SQL query: " . $conn->error);
}

$userCount = ($resultUsers->num_rows > 0) ? $resultUsers->fetch_assoc()['userCount'] : 0;

// Count the number of registered admins
$sqlAdmins = "SELECT COUNT(*) AS adminCount FROM admins";
$resultAdmins = $conn->query($sqlAdmins);

// Check for errors in the query
if ($resultAdmins === false) {
    die("Error in SQL query: " . $conn->error);
}

$adminCount = ($resultAdmins->num_rows > 0) ? $resultAdmins->fetch_assoc()['adminCount'] : 0;


// Count the number of approved properties
$sqlApprovedProperties = "SELECT COUNT(*) AS approvedCount FROM listing_details WHERE approval_status = 'Approved'";
$resultApprovedProperties = $conn->query($sqlApprovedProperties);

// Check for errors in the query
if ($resultApprovedProperties === false) {
    die("Error in SQL query: " . $conn->error);
}

$approvedCount = ($resultApprovedProperties->num_rows > 0) ? $resultApprovedProperties->fetch_assoc()['approvedCount'] : 0;

// Count the number of pending properties
$sqlPendingProperties = "SELECT COUNT(*) AS pendingCount FROM listing_details WHERE approval_status = 'Pending'";
$resultPendingProperties = $conn->query($sqlPendingProperties);

// Check for errors in the query
if ($resultPendingProperties === false) {
    die("Error in SQL query: " . $conn->error);
}

$pendingCount = ($resultPendingProperties->num_rows > 0) ? $resultPendingProperties->fetch_assoc()['pendingCount'] : 0;

// Count the number of rejected properties
$sqlRejectedProperties = "SELECT COUNT(*) AS rejectedCount FROM listing_details WHERE approval_status = 'Rejected'";
$resultRejectedProperties = $conn->query($sqlRejectedProperties);

// Check for errors in the query
if ($resultRejectedProperties === false) {
    die("Error in SQL query: " . $conn->error);
}

$rejectedCount = ($resultRejectedProperties->num_rows > 0) ? $resultRejectedProperties->fetch_assoc()['rejectedCount'] : 0;

// Count the number of feedbacks received
$sqlFeedbacks = "SELECT COUNT(*) AS feedbackCount FROM feedback_web";
$resultFeedbacks = $conn->query($sqlFeedbacks);

// Check for errors in the query
if ($resultFeedbacks === false) {
    die("Error in SQL query: " . $conn->error);
}

$feedbackCount = ($resultFeedbacks->num_rows > 0) ? $resultFeedbacks->fetch_assoc()['feedbackCount'] : 0;

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../style/style_myAccount.css">
</head>
<body>
<div class="container">
        <div class="left-section">
            <img class="profile-photo" src="process_php/uploads/profile_photos/<?php echo $_SESSION["admin_profile_photo"]; ?>" alt="Profile Photo">
            <p class="full-name"><?php echo $truncatedName; ?></p>
                <ul>
                <a href="admin_dashboard.php"><li><button class="button">Dashboard</button></li></a>
                <a href="admin_myAccount.php"><li><button class="button">My Account</button></li></a>
                <a href="view_pendingListings.php"><li><button class="button">Pending Listings</button></li></a>
                <a href="admin_register.php"><li><button class="button">Register</button></li></a> 
                <a href="process_php/process_logout.php"><li><button class="button">Log Out</button></li></a>
            </ul>
        </div>
        <div class="right-section">
            <a class="logo1" href="admin_dashboard.php"><img src="../images/logo.png" alt="Logo"></a>
            <h1 class="main-title">Admin Dashboard</h1>
            <hr style="width: 100%; border: 2px #F28A0A solid">

            <div class="admin-dashboard">
                <div>
                    <!-- Box 3: Number of Pending Properties -->
                    <div class="dashboard-box">
                        <div class="box-number"><?php echo $pendingCount; ?></div>
                        <div class="box-title">Properties Pending</div>
                        <div class="box-button"><a href="view_pendingListings.php">View</a></div>
                    </div>

                    <!-- Box 1: Number of Users Registered -->
                    <div class="dashboard-box">
                        <div class="box-number"><?php echo $userCount; ?></div>
                        <div class="box-title">Users Registered</div>
                        <div class="box-button"><a href="view_users.php">View</a></div>
                    </div>

                </div>
                <div>
                    <!-- Box 2: Number of Approved Properties -->
                    <div class="dashboard-box">
                        <div class="box-number"><?php echo $approvedCount; ?></div>
                        <div class="box-title">Properties Approved</div>
                        <div class="box-button"><a href="view_approved_properties.php">View</a></div>
                    </div>

                    <!-- Box 1: Number of Admins Registered -->
                    <div class="dashboard-box">
                        <div class="box-number"><?php echo $adminCount; ?></div>
                        <div class="box-title">Admins Registered</div>
                        <div class="box-button"><a href="view_admins.php">View</a></div>
                    </div>
                    
                </div>
                <div>
                    <!-- Box 4: Number of Rejected Properties -->
                    <div class="dashboard-box">
                        <div class="box-number"><?php echo $rejectedCount; ?></div>
                        <div class="box-title">Properties Rejected</div>
                        <div class="box-button"><a href="view_rejected_properties.php">View</a></div>
                    </div>

                    <!-- Box 4: Number of Feedbacks Recived -->
                    <div class="dashboard-box">
                        <div class="box-number"><?php echo $feedbackCount; ?></div>
                        <div class="box-title">Feedbacks Received</div>
                        <div class="box-button"><a href="view_feedbacks.php">View</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

