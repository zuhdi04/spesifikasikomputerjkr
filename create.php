<?php
$title = "";
require 'valid.php';

// POST
if ($request_method === "POST") {
    $staffname = $_POST['NamaPenuh'];
    $third = $_POST['jawatangred'];
    $kakitangan = isset($_POST['kakitangan']) ? $_POST['kakitangan'] : "";
    $fifth = isset($_POST['jenispc']) ? $_POST['jenispc'] : "";
    $tarikh = "";
    if( $fifth == "PROJEK" ) $tarikh = isset( $_POST['project_date'] ) ? $_POST['project_date'] : "";
    $pcage = $_POST['tahun'];
    $proc = isset($_POST['proc']) ? $_POST['proc'] : "";
    if( $proc == " " ) $proc = isset( $_POST['otherproc'] ) ? $_POST['otherproc'] : "";
    $ram = $_POST['ram'];
    $systemtype = isset($_POST['systemtype']) ? $_POST['systemtype'] : "";
    $antivirus = $_POST['antivirus'];
    $ipaddress = $_POST['ipaddress'];
    $catatan = $_POST['catatan'];

    $imageData = null;
    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0){
        // Get the uploaded image file
        $imageTmpName = $_FILES['gambar']['tmp_name'];
        $imageSize = $_FILES['gambar']['size'];

        // Ensure image size is reasonable (optional)
        if ($imageSize > 5000000) { // 5MB max
            echo "File is too large.";
            exit;
        }
        // Read image file into binary data
        $imageData = file_get_contents($imageTmpName);
    }
    
    $bahagian = $_SESSION['j_Tab'];
    include 'db_connect.php';
    $sql = "SELECT unitID FROM unit WHERE code=?";
    $check = $conn->prepare($sql);
    $check->bind_param("s", $bahagian);
    $check->execute();
    $check->store_result();
    $check->bind_result($data);
    $check->fetch();
    $check->close();


    # handle null result
    $sql = "INSERT INTO pc(nama_penuh,unitID,jawatan_gred,jenis_kakitangan,jenis_komputer,tarikhtamat,umur_komputer,jenis_processor,saiz_ram,jenis_sistem,antivirus,ipv4_address,catatan)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssssssssss", $staffname, $data, $third, $kakitangan, $fifth, $tarikh, $pcage, $proc, $ram, $systemtype, $antivirus, $ipaddress, $catatan);

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