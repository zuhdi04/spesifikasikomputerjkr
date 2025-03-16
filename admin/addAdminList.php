<?php
// update.php
header('Content-Type: application/json');

if (isset($_POST['addadmin']) || $_POST['username'] != "") {

    $conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

    if ($conn->connect_error) {
        die(json_encode(['message' => 'Connection failed: ' . $conn->connect_error]));
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cawangan = $_POST['cawangan'];
    $pass = password_hash($password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM unit WHERE nama=?");
    $check->bind_param("s", $cawangan);
    $check->execute();
    $check->store_result();
    $check->bind_result($data);
    $check->fetch();
    $check->close();

    if ($data != null) {

        $sql = "INSERT INTO admin(username,unitID,password,password_encrypt)
VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $data, $password, $pass);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Update successful']);
            setcookie("alert", "success_add", time() + (30), "/");
        } else {
            echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
        }

        $stmt->close();
    }

    $conn->close();
    header("Location: ADMIN-staff_details.html");
    exit;
} else {
    header("Location: ADMIN-staff_details.html");
    exit;
}

?>