<?php
header('Content-Type: application/json');

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Get the filename parameter
// $tablename = isset($_GET['tablename']) ? $_GET['tablename'] : '';
// $id = isset($_GET['id']) ? strval($_GET['id']) : '';
// $booking = json_decode($_COOKIE['booking'],true);
// $roomtype = $booking['roomtype'];

// Prepare the SQL statement based on the filename
// Ensure to sanitize and validate the table name to prevent SQL injection
// $validTables = ['customer_account', 'staff_account','feedback']; // Example valid tables
// if (!in_array($tablename, $validTables)) {
//     echo json_encode(['error' => 'Invalid table name']);
//     exit;
// }
// $stmt = $conn->prepare("SELECT id FROM hotel_rooms"); // Select all columns from the specified table
// $res="";
// if($roomtype!=""){
//     $stmt = $conn->prepare("SELECT * FROM hotel_rooms WHERE room_id=$roomtype"); // Select column from the specified table
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $data = $result->fetch_all(MYSQLI_ASSOC);
//     $stmt->close();
//     $res = json_encode($data);
// }
$target = $_GET['content'];
$sql = "SELECT pcID FROM pc WHERE nama_penuh=?";
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

// echo $res;

// Get the result

// Fetch all results

// Return the results as a JSON array

// Close the statement and connection
?>