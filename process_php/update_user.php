<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include('db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update personal information
    if (isset($_POST["first-name"]) && isset($_POST["last-name"]) && isset($_POST["birthdate"])) {
        $firstName = $_POST["first-name"];
        $lastName = $_POST["last-name"];
        $birthdate = $_POST["birthdate"];

        $user_id = $_SESSION["user_id"];
        $updatePersonalInfoSQL = "UPDATE users SET first_name='$firstName', last_name='$lastName', birthdate='$birthdate' WHERE user_id='$user_id'";
        if ($conn->query($updatePersonalInfoSQL) === TRUE) {
            $_SESSION["user_name"] = $firstName . " " . $lastName;
            $_SESSION["profile_update_success"] = true;
        }else {
            $_SESSION["profile_update_error"] = "Error updating profile information!" . $conn->error;
        }
    }

    // Delete old profile photo if it exists
    $user_id = $_SESSION["user_id"];
    $selectOldProfilePhotoSQL = "SELECT profile_photo FROM users WHERE user_id='$user_id'";
    $result = $conn->query($selectOldProfilePhotoSQL);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $oldProfilePhoto = $row["profile_photo"];
        if (!empty($oldProfilePhoto)) {
            unlink($oldProfilePhoto); // Delete the old profile photo file from the server
        }
    }

    // Update profile photo
    if (isset($_FILES["profile-photo"]) && $_FILES["profile-photo"]["error"] == 0) {
        $targetDir = "uploads/profile_photos/";
        $fileName = basename($_FILES["profile-photo"]["name"]);
        $targetFile = $targetDir . basename($_FILES["profile-photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION["photo_update_error"] = "Error uploading profile photo. Please try again.";
        } else {
            // If everything is OK, attempt to upload the file
            if (move_uploaded_file($_FILES["profile-photo"]["tmp_name"], $targetFile)) {
                // Update the database with the new profile photo filename
                $updateProfilePhotoSQL = "UPDATE users SET profile_photo='$fileName' WHERE user_id='$user_id'";
                if ($conn->query($updateProfilePhotoSQL) === TRUE) {
                    $_SESSION["photo_update_success"] = true;
                    $_SESSION["user_profile_photo"] = $fileName; // Update session variable with new profile photo filename
                } else {
                    $_SESSION["photo_update_error"] = "Error updating profile photo: " . $conn->error;
                }
            } else {
                $_SESSION["photo_update_error"] = "Error uploading profile photo. Please try again.";
            }
        }
    }



    // Update email
    if (isset($_POST["new-email"])) {
        $newEmail = $_POST["new-email"];
        $user_id = $_SESSION["user_id"];
        $updateEmailSQL = "UPDATE users SET email='$newEmail' WHERE user_id='$user_id'";
        if ($conn->query($updateEmailSQL) === TRUE) {
            $_SESSION["email_update_success"] = true;
        }else {
            $_SESSION["email_update_error"] = "Error updating email!" . $conn->error;
        }
    }

    // Update password
    if (isset($_POST["password"]) && isset($_POST["newpassword"])) {
        $oldPassword = $_POST["password"];
        $newPassword = $_POST["newpassword"];
        $user_id = $_SESSION["user_id"];

        // Retrieve the current hashed password from the database
        $getCurrentPasswordSQL = "SELECT password FROM users WHERE user_id='$user_id'";
        $result = $conn->query($getCurrentPasswordSQL);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row["password"];

            // Verify the old password
            if (password_verify($oldPassword, $hashedPassword)) {
                // Hash the new password and update it in the database
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updatePasswordSQL = "UPDATE users SET password='$newHashedPassword' WHERE user_id='$user_id'";
                if ($conn->query($updatePasswordSQL) === TRUE) {
                    $_SESSION["password_update_success"] = true;
                } else {
                    $_SESSION["password_update_error"] = "Error updating password!" . $conn->error;
                }
            } else {
                $_SESSION["password_update_error"] = "Incorrect old password. Please try again!";
            }
        }
    }
}

$conn->close();
header("Location: ../myAccount.php");
exit();
?>


