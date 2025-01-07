<?php
// update.php
header('Content-Type: application/json');

if (isset($_POST['SAVE'])) {

$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

if ($conn->connect_error) {
    die(json_encode(['message' => 'Connection failed: ' . $conn->connect_error]));
}

$staffname = $_POST['NamaPenuh'];
$second = $_POST['bahagian'];
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

$sql = "INSERT INTO pc(nama_penuh,bahagian_cawangan_daerah,jawatan_gred,jenis_kakitangan,jenis_komputer,umur_komputer,jenis_processor,saiz_ram,jenis_sistem,antivirus,ipv4_address,catatan)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssss", $staffname, $second, $third, $kakitangan, $fifth, $pcage, $proc, $ram, $systemtype, $antivirus, $ipaddress, $catatan);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Update successful']);
} else {
    echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();

header("Location: details-form.html");
exit;
}
else {
    header("Location: details-form.html");
    exit;
}

?>