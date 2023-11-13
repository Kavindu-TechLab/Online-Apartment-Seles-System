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
            <h1 class="main-title">My Account</h1>
            <hr style="width: 100%; border: 2px #F28A0A solid">
            <h2 class="sub-titles">Personal Information</h2>
            <form method="post" action="process_php/update_admin.php">
                <div class="name-field">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first-name" value="<?php echo $first_name; ?>" required><br>

                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last-name" value="<?php echo $last_name; ?>" required><br>

                    <label for="birthdate">Birth Date:</label>
                    <input type="date" id="birthdate" name="birthdate" value="<?php echo $birthdate; ?>" required>
                    <?php
                    // Check for password update success or error messages
                    if (isset($_SESSION["profile_update_success"])) {
                        echo "<p class='update-success'>Email updated successfully!</p>";
                        unset($_SESSION["profile_update_success"]);
                    } elseif (isset($_SESSION["profile_update_error"])) {
                        echo "<p class='update-error'>" . $_SESSION["profile_update_error"] . "</p>";
                        unset($_SESSION["profile_update_error"]);
                    }
                    ?>
                </div>  
                <button style="margin-bottom: 25px" class="button1" type="submit">Update</button>
            </form>

            <form method="post" action="process_php/update_admin.php" enctype="multipart/form-data">
                <label for="profile-photo">Profile Photo:</label>
                <input style="margin-bottom: 10px" type="file" id="profile-photo" name="profile-photo"><br>
                <?php
                    // Check for password update success or error messages
                    if (isset($_SESSION["photo_update_success"])) {
                        echo "<p class='update-success'>Profile photo updated successfully!</p>";
                        unset($_SESSION["photo_update_success"]);
                    } elseif (isset($_SESSION["photo_update_error"])) {
                        echo "<p class='update-error'>" . $_SESSION["photo_update_error"] . "</p>";
                        unset($_SESSION["photo_update_error"]);
                    }
                    ?>
                <button class="button1" type="submit">Update Profile Photo</button>
            </form>

            <h2 class="sub-titles">Login & Security</h2>
            <form method="post" action="process_php/update_admin.php">
                <label for="new-email">New Email:</label>
                <input type="email" id="new-email" name="new-email" value="<?php echo $email; ?>" required><br>
                <?php
                    // Check for password update success or error messages
                    if (isset($_SESSION["email_update_success"])) {
                        echo "<p class='update-success'>Email updated successfully!</p>";
                        unset($_SESSION["email_update_success"]);
                    } elseif (isset($_SESSION["email_update_error"])) {
                        echo "<p class='update-error'>" . $_SESSION["email_update_error"] . "</p>";
                        unset($_SESSION["email_update_error"]);
                    }
                ?>
                <button class="button1" type="submit">Change Email</button><br>
            </form>

            <form method="post" action="process_php/update_admin.php">
                <label for="password">Old Password:</label>
                <input type="password" id="password" name="password" required><br>
                <label for="password">New Password:</label>
                <input type="password" id="newpassword" name="newpassword" required><br>
                <?php
                    // Check for password update success or error messages
                    if (isset($_SESSION["password_update_success"])) {
                        echo "<p class='update-success'>Password updated successfully!</p>";
                        unset($_SESSION["password_update_success"]);
                    } elseif (isset($_SESSION["password_update_error"])) {
                        echo "<p class='update-error'>" . $_SESSION["password_update_error"] . "</p>";
                        unset($_SESSION["password_update_error"]);
                    }
                ?>
                <button class="button1" type="submit">Change Password</button>
            </form>
        </div>
    </div>
</body>
</html>
