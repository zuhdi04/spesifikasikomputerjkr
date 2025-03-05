<!-- update.php -->
<?php
require 'validate_acc.php';

// if (isset($_POST['SAVE'])||$_POST['NamaPenuh']!="") {

// $conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

// if ($conn->connect_error) {
//     die(json_encode(['message' => 'Connection failed: ' . $conn->connect_error]));
// }

$staffname = $_POST['NamaPenuh'];
// $second = $_POST['bahagian'];
$third = $_POST['jawatangred'];
$kakitangan = isset($_POST['kakitangan'])?$_POST['kakitangan']:"";
$fifth = $_POST['jenispc'];
$pcage = $_POST['tahun'];
$proc = isset($_POST['proc'])?$_POST['proc']:"";
$ram = $_POST['ram'];
$systemtype = isset($_POST['systemtype'])?$_POST['systemtype']:"";
$antivirus = $_POST['antivirus'];
$ipaddress = $_POST['ipaddress'];
$catatan = $_POST['catatan'];
$id = isset($_POST['id'])?intval($_POST['id']):0;

$sql = "UPDATE pc SET nama_penuh=?,
jawatan_gred=?,
jenis_kakitangan=?,
jenis_komputer=?,
umur_komputer=?,
jenis_processor=?,
saiz_ram=?,
jenis_sistem=?,
antivirus=?,
ipv4_address=?,
catatan=?
WHERE pcID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssi", $staffname, $third, $kakitangan, $fifth, $pcage, $proc, $ram, $systemtype, $antivirus, $ipaddress, $catatan, $id);

if ($stmt->execute()) {
    $_SESSION["notification"] = 'Update successful';
    echo json_encode(['message' => 'Update successful']);
} else {
    echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();

// setcookie("alert", "success_edit", time() + (30), "/");

header("Location: ".$pages->edit->url."?form=$id");
exit;
// }
// else {
//     header("Location: details-edit.php");
//     exit;
// }

?>