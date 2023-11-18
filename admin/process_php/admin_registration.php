<?php
include('db_connection.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $birthdate = $_POST["birthdate"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
    $profilePhoto = $_FILES["profilePhoto"]["name"]; // Retrieve the profile photo file name

    if ($password != $confirmPassword) {
        $_SESSION["register_error"] = "Password and confirm password do not match";
        header("Location: ../admin_register.php"); // Redirect back to the registration page
        exit();
    }

    // Upload profile photo to the server
    $targetDirectory = "uploads/profile_photos/";
    $targetFilePath = $targetDirectory . basename($profilePhoto);
    move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetFilePath);

    // Insert data into the database
    $sql = "INSERT INTO admins (first_name, last_name, birthdate, email, password, profile_photo)
            VALUES ('$firstName', '$lastName', '$birthdate', '$email', '$hashedPassword', '$profilePhoto')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
