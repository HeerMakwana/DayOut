<?php

$servername = "localhost"; // Or your database host
$username = "root";      // Your database username
$password = "";          // Your database password
$dbname = "dayout";        // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to utf8mb4 for proper handling of emojis and special characters
$conn->set_charset("utf8mb4");

?>