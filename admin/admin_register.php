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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Registration</title>
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
                    <a href="admin_myAccount.php"><li><button class="button">Personal Details</button></li></a>
                    <a href="view_pendingListings.php"><li><button class="button">Pending Listings</button></li></a>
                    <a href="admin_register.php"><li><button class="button">Register</button></li></a>
                    <a href="process_php/process_logout.php"><li><button class="button">Log Out</button></li></a>
                </ul>
            </div>
            <div class="right-section">
                <a class="logo1" href="admin_dashboard.php"><img src="../images/logo.png" alt="Logo"></a>
                <a href="admin_register.php"><h1 class="main-title">Admin Registraion</h1></a>
                <hr style="width: 100%; border: 2px #F28A0A solid">

                <!-- Display error message if set in the session -->
                <?php
                    if (isset($_SESSION["error_message"])) {
                        echo '<div class="error-message">' . $_SESSION["error_message"] . '</div>';
                        unset($_SESSION["error_message"]); // Clear the error message from session
                    }
                    if (isset($_SESSION["successful_message"])) {
                        echo '<div style="color: green;" class="error-message">' . $_SESSION["successful_message"] . '</div>';
                        unset($_SESSION["successful_message"]); // Clear the error message from session
                    }
                ?>

                <!-- Registration Form -->
                <form style="padding: 30px" action="process_php/admin_registration.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <label for="firstName">First Name</label>
                        <input style="height: 10px" type="text" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-row">
                        <label for="lastName">Last Name</label>
                        <input style="height: 10px" type="text" id="lastName" name="lastName" required>
                    </div>
                    <div class="form-row">
                        <label for="birthdate">Birth Date</label>
                        <input type="date" id="birthdate" name="birthdate" required>
                    </div>
                    <div class="form-row">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-row">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-row">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <div class="form-row">
                        <label for="profilePhoto">Profile Photo</label>
                        <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*">
                    </div>
                    <button type="submit" class="button1">Register</button>
                </form>
            </div>
        </div>
    </body>
</html>


