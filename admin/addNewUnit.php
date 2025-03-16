<?php
// check nama, create uniqid then compare dengan existing
header('Content-Type: application/json');

if (isset($_POST['addunit'])) {

    $cawangan = $_POST['cawangan'];
    $uniqcode = uniqid();

    $conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

    if ($conn->connect_error) {
        die(json_encode(['message' => 'Connection failed: ' . $conn->connect_error]));
    }


    $check = $conn->prepare("SELECT unitCode FROM unit WHERE unitCode=?");
    $check->bind_param("s", $uniqcode);
    $check->execute();
    $check->store_result();
    $check->bind_result($data);
    $check->fetch();
    // $check->close();

    $check = $conn->prepare("SELECT nama FROM unit WHERE nama=?");
    $check->bind_param("s", $cawangan);
    $check->execute();
    $check->store_result();
    $check->bind_result($data);
    $check->fetch();
    $check->close();

    if ($data == null) {

        $sql = "INSERT INTO unit(nama,unitCode)
    VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $cawangan, $uniqcode);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Update successful']);
            setcookie("alert", "success_add", time() + (30), "/");
        } else {
            echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
        }

        $stmt->close();
    }

    $conn->close();
    header("Location: ADMIN-unit_details.html");
    exit;
} else {
    header("Location: ADMIN-unit_details.html");
    exit;
}

?>