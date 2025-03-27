<?php
$title = "";
require '../valid.php';

$id = $_GET['form'];
// if($request_method === "GET"){
//     include '../layout/header.php';
//     include '../layout/edit_spesifikasi.php';
//     include '../layout/footer.php';
// }
if ($request_method === "POST") {

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $staffname = $_POST['NamaPenuh'];
    $second = $_POST['cawangan'];
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

    include '../db_connect.php';
    $sql = "SELECT unitID FROM unit WHERE nama=?";
    $check = $conn->prepare($sql);
    $check->bind_param("s", $second);
    $check->execute();
    $check->store_result();
    $check->bind_result($data);
    $check->fetch();
    $check->close();

    $sql = "UPDATE pc SET nama_penuh=?,
    unitID=?,
    jawatan_gred=?,
    jenis_kakitangan=?,
    jenis_komputer=?,
    tarikhtamat=?,
    umur_komputer=?,
    jenis_processor=?,
    saiz_ram=?,
    jenis_sistem=?,
    antivirus=?,
    ipv4_address=?,
    catatan=?
    WHERE pcID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssssssssssi", $staffname, $data, $third, $kakitangan, $fifth, $tarikh, $pcage, $proc, $ram, $systemtype, $antivirus, $ipaddress, $catatan, $id);

    if ($stmt->execute()) {
        $_SESSION["notify"] = ['text' => 'Update successful'];
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
// GET
include '../db_connect.php';
$sql = "SELECT * FROM pc WHERE pcID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_array(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
if ($data == null) {
    header("Location: .");
    exit;
}
include '../layout/header.php';

include '../../component/spesifikasiform.php';

include '../layout/footer.php';
?>