<?php
header('Content-Type: application/json');

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$stmt = $conn->prepare("SELECT nama,id FROM unit ORDER BY nama");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$res = json_encode($data);

$conn->close();

echo $res;

// Get the result

// Fetch all results

// Return the results as a JSON array

// Close the statement and connection
?>