<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include your database connection file
include('../process_php/db_connection.php');

// Check for a valid database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


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

// Retrieve search parameter if provided
$searchTerm = isset($_GET['user']) ? $_GET['user'] : '';

// Convert the search term to lowercase
$searchTermLower = strtolower($searchTerm);

// Retrieve approved users from the database with search option
$sqlApprovedUsers = "SELECT * FROM users WHERE 
    LOWER(first_name) LIKE '%$searchTermLower%' OR
    LOWER(last_name) LIKE '%$searchTermLower%' OR
    LOWER(email) LIKE '%$searchTermLower%'";

$resultApprovedUsers = $conn->query($sqlApprovedUsers);

// Check for errors in the query
if ($resultApprovedUsers === false) {
    die("Error in SQL query: " . $conn->error);
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Approved Users</title>
        <link rel="stylesheet" type="text/css" href="../style/style_myAccount.css">
        <link rel="stylesheet" type="text/css" href="style/style_view_approved_properties.css">
    </head>
    <body>
        <div class="container">
            <div class="left-section">
            <img class="profile-photo" src="process_php/uploads/profile_photos/<?php echo $_SESSION["admin_profile_photo"]; ?>" alt="Profile Photo">
                <p class="full-name"><?php echo $truncatedName; ?></p>
                <ul>
                    <a href="admin_dashboard.php"><li><button class="button">Dashboard</button></li></a>
                    <a href="admin_myAccount.php"><li><button class="button">My Account</button></li></a>
                    <a href="admin_pendingListings.php"><li><button class="button">Pending Listings</button></li></a>
                    <a href="admin_register.php"><li><button class="button">Register</button></li></a>
                    <a href="process_php/process_logout.php"><li><button class="button">Log Out</button></li></a>
                </ul>
            </div>
            <div class="right-section">
                <a class="logo1" href="admin_dashboard.php"><img src="../images/logo.png" alt="Logo"></a>
                <a href="view_users.php"><h1 class="main-title">All Users</h1></a>
                <hr style="width: 100%; border: 2px #F28A0A solid">

                <!-- Search form -->
                <form action="view_users.php" method="GET">
                    <div class="search-container">
                        <div class="search-group">
                            <input type="text" id="search-input" name="user" placeholder="Search User..." value="<?php echo $searchTerm; ?>">
                            <button type="submit" id="search-button"><img src="../images/search.png" alt="Search"></button>
                        </div>
                    </div>
                </form>

                <div class="all-users">
                    <?php
                    // Display each approved user in a separate box
                    while ($row = $resultApprovedUsers->fetch_assoc()) {
                        $fullName = $row['first_name'] . ' ' . $row['last_name'];
                        $truncatedName = (strlen($fullName) > 15) ? substr($fullName, 0, 15) . '...' : $fullName;
                    ?>
                            <div class="user-details">
                                <div style="text-align: center;"> 
                                    <img class="profile-photo" src="../process_php/uploads/profile_photos/<?php echo $row['profile_photo']; ?>" alt="Profile Photo">
                                </div>
                                <div class="box-data"><?php echo $truncatedName; ?></div>
                                <div class="box-data"><?php echo $row['email']; ?></div>
                                <div class="box-data">Birthdate: <?php echo $row['birthdate']; ?></div>
                                <form action="process_php/delete_user.php" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                    <button type="submit" class="delete-button">Delete</button>
                                </form>
                            </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>


