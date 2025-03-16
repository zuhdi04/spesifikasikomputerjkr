<?php

$servername = "localhost";
$db_username = "root"; // Your database username
$password = ""; // Your database password
$database = "zuhdiscmsdb"; // Your database name

// Create connection
$conn = new mysqli($servername, $db_username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>