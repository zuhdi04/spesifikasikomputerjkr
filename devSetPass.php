<?php
// Step 1: Establish a connection to the MySQL database
$servername = "localhost"; // Database server
$username = "root";        // MySQL username
$password = "";            // MySQL password
$dbname = "zuhdi scmsdb";       // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Write the SQL query to insert data
$name = "name"; // <- set username
$password = "pass"; // <- set password
$pass = password_hash($password, PASSWORD_DEFAULT);

// Step 3: Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");

// Bind parameters to the query
$stmt->bind_param("ss", $name, $pass); // "ss" means string, string

// Step 4: Execute the query
if ($stmt->execute()) {
    echo "New record created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
