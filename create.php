<?php
$title = "";
require 'valid.php';

// POST
if ($request_method === "POST") {
    $staffname = $_POST['NamaPenuh'];
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
    
    $bahagian = $_SESSION['j_Tab'];
    include 'db_connect.php';
    $sql = "SELECT id FROM unit WHERE unitCode=?";
    $check = $conn->prepare($sql);
    $check->bind_param("s", $bahagian);
    $check->execute();
    $check->store_result();
    $check->bind_result($data);
    $check->fetch();
    $check->close();


    // # handle null result
    $sql = "INSERT INTO pc(nama_penuh,unitID,jawatan_gred,jenis_kakitangan,jenis_komputer,umur_komputer,jenis_processor,saiz_ram,jenis_sistem,antivirus,ipv4_address,catatan)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssssssss", $staffname, $data, $third, $kakitangan, $fifth, $pcage, $proc, $ram, $systemtype, $antivirus, $ipaddress, $catatan);

    if ($stmt->execute()) {
        $_SESSION["notify"] = ['text' => 'Add successful'];
        // echo json_encode(['message' => 'Update successful']);
    } else {
        // echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();

    if ($bahagian === 0)
        header("Location: ADMIN-computer_details.html");
    else if ($bahagian > 0)
        header("Location: " . $pages->spesifikasi->index);
    // header("Location: STAFF-computer_details.html?u=".$bahagian);
    exit;
}

// GET
$data = array("pcID"=>"","nama_penuh"=>"","jawatan_gred"=>"","jenis_kakitangan"=>"","jenis_komputer"=>"","umur_komputer"=>"","jenis_processor"=>"","saiz_ram"=>"","jenis_sistem"=>"","antivirus"=>"","ipv4_address"=>"","catatan"=>"","unitID"=>"","id"=>"","nama"=>"","unitCode"=>"");

include('layout/header.php');

include('component/spesifikasiform.php');


include('layout/footer.php'); ?>