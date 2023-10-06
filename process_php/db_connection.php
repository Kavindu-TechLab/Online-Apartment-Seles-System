<?php
$servername = "localhost"; // Server name
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "apartmint"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
