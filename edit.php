<?php
$title = "";
require 'valid.php';

$id = $_GET['form'];

// POST
if ($request_method === "POST") {
    $staffname = $_POST['NamaPenuh'];
    // $second = $_POST['bahagian'];
    $third = $_POST['jawatangred'];
    $kakitangan = isset($_POST['kakitangan']) ? $_POST['kakitangan'] : "";
    $fifth = $_POST['jenispc'];
    $pcage = $_POST['tahun'];
    $proc = isset($_POST['proc']) ? $_POST['proc'] : "";
    if( $proc == " " ) $proc = isset( $_POST['otherproc'] ) ? $_POST['otherproc'] : "";
    $ram = $_POST['ram'];
    $systemtype = isset($_POST['systemtype']) ? $_POST['systemtype'] : "";
    $antivirus = $_POST['antivirus'];
    $ipaddress = $_POST['ipaddress'];
    $catatan = $_POST['catatan'];
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;


    include 'db_connect.php';
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
        $_SESSION["notify"] = ['' => '', 'text' => 'Update successful'];
        // echo json_encode(['message' => 'Update successful']);
    } else {
        // echo json_encode(['message' => 'Update failed: ' . $stmt->error]);
    }
    $stmt->close();
    $conn->close();

    header("Location: " . $pages->spesifikasi->edit . "?form=$id");
    exit;

}

?>

<?php
include 'db_connect.php';
$sql = "SELECT * FROM pc LEFT JOIN unit ON pc.unitID = unit.id WHERE pcID=? AND unitCode=?";
// $sql = "SELECT * FROM pc WHERE pcID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $_SESSION['j_Tab']);
// $stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_array(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

if ($data == null) {
    header("Location: .");
    exit;
}
include('layout/header.php');

include('component/spesifikasiform.php');

include('layout/footer.php'); ?>