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

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style/style_myAccount.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img class="profile-photo" src="process_php/uploads/profile_photos/<?php echo $_SESSION["user_profile_photo"]; ?>" alt="Profile Photo">
            <p class="full-name"><?php echo $truncatedName; ?></p>
                <ul>
                <a href="index.php"><li><button class="button">Home</button></li></a>
                <a href="myAccount.php"><li><button class="button">Personal Details</button></li></a>
                <a href="myListing.php"><li><button class="button">My Listings</button></li></a>
                <a href="#"><li><button class="button">Terms & Conditions</button></li></a>
                <a href="#"><li><button class="button">Privercy & Policy</button></li></a>
                <a href="process_php/process_logout.php"><li><button class="button">Log Out</button></li></a>
            </ul>
        </div>
        <div class="right-section">
            <a class="logo1" href="index.php"><img src="images/logo.png" alt="Logo"></a>
            <h1 class="main-title">My Account</h1>
            <hr style="width: 100%; border: 2px #F28A0A solid">
            <h2 class="sub-titles">Personal Information</h2>
            <form method="post" action="process_php/update_user.php">
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

            <form method="post" action="process_php/update_user.php" enctype="multipart/form-data">
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
            <form method="post" action="process_php/update_user.php">
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

            <form method="post" action="process_php/update_user.php">
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

            <form method="post" action="process_php/deactivate_account.php">
                <h2 class="sub-titles">Account Data</h2>
                <label>Deactivate Account</label>
                <p>By deactivating your account, you will no longer be able to access your account or sign in to Apartments.com.</p>
                <button class="button1" type="submit" name="deactivate-account" value="Deactivate Account">Deactivate Account</button>
            </form>
        </div>
    </div>
</body>
</html>

