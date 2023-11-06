<?php
session_start();

include('db_connection.php');

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $rating = $_POST['rating'];
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // If there are no errors, insert data into the database
    if (empty($errors)) {
        $sql = "INSERT INTO feedback_web (feedback_rating, feedback_name, feedback_head, feedback_discription) VALUES ('$rating', '$name', '$heading', '$description')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>


