<?php
if ( isset( $_GET["u"] ) ) {
// session_start();
$bahagian = $_GET["u"];
// update.php
header('Content-Type: application/json');

if (isset($_POST['SAVE'])||$_POST['NamaPenuh']!="") {

$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

if ($conn->connect_error) {
    die(json_encode(['message' => 'Connection failed: ' . $conn->connect_error]));
}

$staffname = $_POST['NamaPenuh'];
// $second = $_POST['bahagian'];
$third = $_POST['jawatangred'];
$kakitangan = $_POST['kakitangan'];
$fifth = $_POST['jenispc'];
$pcage = $_POST['tahun'];
$proc = isset($_POST['proc'])?$_POST['proc']:"";
$ram = $_POST['ram'];
$systemtype = isset($_POST['systemtype'])?$_POST['systemtype']:"";
$antivirus = $_POST['antivirus'];
$ipaddress = $_POST['ipaddress'];
$catatan = $_POST['catatan'];

$sql = "INSERT INTO pc(nama_penuh,unitID,jawatan_gred,jenis_kakitangan,jenis_komputer,umur_komputer,jenis_processor,saiz_ram,jenis_sistem,antivirus,ipv4_address,catatan)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sissssssssss", $staffname, $bahagian, $third, $kakitangan, $fifth, $pcage, $proc, $ram, $systemtype, $antivirus, $ipaddress, $catatan);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Update successful']);
} else {
    echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();

setcookie("alert", "success_add", time() + (30), "/");
if ($bahagian===0) 
    header("Location: ADMIN-computer_details.html?u=".$bahagian);
else if ($bahagian>0) 
    header("Location: STAFF-computer_details.html?u=".$bahagian);
exit;
}
else {
    header("Location: details-form.html?u=".$bahagian);
    exit;
}
}
?>