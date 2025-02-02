<?php
// session_start();
header('Content-Type: application/json');

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}
// if(isset($_SESSION['unitID'])){
//     $stmt = $conn->prepare("SELECT * FROM pc INNER JOIN unit ON pc.unitID=unit.id WHERE unitID=?");
//     $stmt->bind_param("i", $_SESSION['unitID']);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $data = $result->fetch_all(MYSQLI_ASSOC);
//     $stmt->close();
// }
if(isset($_GET['u'])){
    $stmt = $conn->prepare("SELECT * FROM pc INNER JOIN unit ON pc.unitID=unit.id WHERE unitCode=? ORDER BY nama_penuh");
    $stmt->bind_param("s", $_GET['u']);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
else $data=[];
$res = json_encode($data);

$conn->close();

echo $res;

// Get the result

// Fetch all results

// Return the results as a JSON array

// Close the statement and connection
?>