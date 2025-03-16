<?php
// if ( isset( $_GET["u"] ) ) {
// session_start();
// $bahagian = $_GET["u"];
// update.php
header('Content-Type: application/json');

if (isset($_POST['SAVE']) || $_POST['NamaPenuh'] != "") {

    $conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

    if ($conn->connect_error) {
        die(json_encode(['message' => 'Connection failed: ' . $conn->connect_error]));
    }

    $staffname = $_POST['NamaPenuh'];
    $second = $_POST['cawangan'];
    $third = $_POST['jawatangred'];
    $kakitangan = isset($_POST['kakitangan']) ? $_POST['kakitangan'] : "";
    $fifth = $_POST['jenispc'];
    $pcage = $_POST['tahun'];
    $proc = isset($_POST['proc']) ? $_POST['proc'] : "";
    $ram = $_POST['ram'];
    $systemtype = isset($_POST['systemtype']) ? $_POST['systemtype'] : "";
    $antivirus = $_POST['antivirus'];
    $ipaddress = $_POST['ipaddress'];
    $catatan = $_POST['catatan'];

    $sql = "SELECT id FROM unit WHERE nama=?";
    $check = $conn->prepare($sql);
    $check->bind_param("s", $second);
    $check->execute();
    $check->store_result();
    $check->bind_result($data);
    $check->fetch();
    $check->close();

    if ($data != null) {
        // # handle null result
        $sql = "INSERT INTO pc(nama_penuh,unitID,jawatan_gred,jenis_kakitangan,jenis_komputer,umur_komputer,jenis_processor,saiz_ram,jenis_sistem,antivirus,ipv4_address,catatan)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sissssssssss", $staffname, $data, $third, $kakitangan, $fifth, $pcage, $proc, $ram, $systemtype, $antivirus, $ipaddress, $catatan);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Update successful']);
            setcookie("alert", "success_add", time() + (30), "/");
        } else {
            echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
        }

        $stmt->close();
    }
    $conn->close();

    header("Location: ADMIN-computer_details.html");
    exit;
} else {
    header("Location: details_form.html");
    exit;
}
// }
?>