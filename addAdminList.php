<?php
// update.php
header('Content-Type: application/json');

if (isset($_POST['addadmin'])||$_POST['username']!="") {

$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

if ($conn->connect_error) {
    die(json_encode(['message' => 'Connection failed: ' . $conn->connect_error]));
}

$username = $_POST['username'];
$password = $_POST['password'];
$cawangan = $_POST['cawangan'];
$pass = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO admin(username,cawangan,password,password_encrypt)
VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username, $cawangan, $password, $pass);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Update successful']);
} else {
    echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
setcookie("alert", "success_add", time() + (30), "/");
header("Location: dashboard.html");
exit;
}
else {
    header("Location: dashboard.html");
    exit;
}

?>