<?php
header('Content-Type: application/json');

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$target = $_GET['t'];
$sql = "SELECT unitCode FROM unit WHERE unitCode=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$target);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($data);
$stmt->fetch();
$stmt->close();
$conn->close();
// if ($data!=$target) echo json_encode(null);
// else echo json_encode(!null);
$res = json_encode($data);
echo $res;
// echo $data;


?>