<?php
header('Content-Type: application/json');

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$target = $_POST['target'];
$stmt = $conn->prepare("DELETE FROM pc WHERE pcID=?");
$stmt->bind_param("i", $target);
if ($stmt->execute()) {
    echo json_encode(['message' => 'Update successful']);
} else {
    echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
}
$stmt->close();
$conn->close();
?>