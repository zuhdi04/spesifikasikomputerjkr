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

include('layout/header.php'); ?>

<div class="content">
    <!-- Form Section -->
    <form id="editdetailsform" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"
        class="form-container">
        <input type="text" name="id" value="<?php echo $data['pcID']; ?>" hidden>
        <label for="fullname">Nama Penuh:</label>
        <input type="text" name="NamaPenuh" id="fullname" placeholder="Masukkan nama penuh"
            value="<?php echo $data['nama_penuh']; ?>" required>

        <label for="bahagian" hidden>Bahagian / Cawangan / Daerah:</label>
        <input type="text" name="bahagian" id="bahagian" placeholder="Bahagian atau daerah" value="" hidden>

        <label for="jawatangred">Jawatan dan Gred:</label>
        <input type="text" name="jawatangred" id="jawatangred" placeholder="Jawatan dan gred"
            value="<?php echo $data['jawatan_gred']; ?>">

        <!-- <label for="kakitangan">Kakitangan Persekutuan / Negeri:</label>
    <select name="kakitangan" id="kakitangan">
        <option id="PC NEGERI" value="PC NEGERI">PC Negeri</option>
        <option id="PC PERSEKUTUAN" value="PC PERSEKUTUAN">PC Persekutuan</option>
    </select> -->
        <label>Kakitangan Persekutuan / Negeri:</label>
        <div class="radio-group">
            <input type="radio" name="kakitangan" value="NEGERI" id="NEGERI"><label for="negeri">Negeri</label>
            <input type="radio" name="kakitangan" value="PERSEKUTUAN" id="PERSEKUTUAN"><label
                for="persekutuan">Persekutuan</label>
        </div>

        <label for="jenispc">Jenis Komputer:</label>
        <input type="text" name="jenispc" id="jenispc" placeholder="Jenis komputer"
            value="<?php echo $data['jenis_komputer']; ?>">

        <label for="tahun">Umur Komputer (Tahun):</label>
        <input type="number" name="tahun" id="tahun" placeholder="Umur komputer"
            value="<?php echo $data['umur_komputer']; ?>">

        <label>Jenis Processor:</label>
        <div class="radio-group">
            <input type="radio" name="proc" value="i3" id="i3"><label for="i3">i3</label>
            <input type="radio" name="proc" value="i5" id="i5"><label for="i5">i5</label>
            <input type="radio" name="proc" value="i7" id="i7"><label for="i7">i7</label>
            <input type="radio" name="proc" id="otherProcRadio" value=" ">
            <label for="otherProcRadio">Others:</label>
            <input type="text" id="otherProcTxtBox" disabled onkeyup="setOtherProcValue()">
        </div>

        <label for="ram">RAM:</label>
        <select name="ram" id="ram">
            <option id="ram_2" value="2">2 GB</option>
            <option id="ram_4" value="4">4 GB</option>
            <option id="ram_6" value="6">6 GB</option>
            <option id="ram_8" value="8">8 GB</option>
        </select>

        <label>System Type:</label>
        <div class="radio-group">
            <input type="radio" name="systemtype" value="32BIT" id="32BIT"><label for="32bit">32 BIT</label>
            <input type="radio" name="systemtype" value="64BIT" id="64BIT"><label for="64bit">64 BIT</label>
        </div>

        <label for="antivirus">Antivirus:</label>
        <input type="text" name="antivirus" id="antivirus" placeholder="Antivirus digunakan"
            value="<?php echo $data['antivirus']; ?>">

        <label for="ipaddress">IPv4 Address:</label>
        <input type="text" name="ipaddress" id="ipaddress" placeholder="Contoh: 192.168.0.1"
            value="<?php echo $data['ipv4_address']; ?>">

        <label for="catatan">Catatan:</label>
        <textarea name="catatan" id="catatan" placeholder="Tambahan informasi"
            value="<?php echo $data['catatan']; ?>"></textarea>

        <input name="SAVE" class="button" type="submit" value="SAVE">
        <input type="reset" class="reset" type="reset" value="RESET">
    </form>
</div>

<script>
    if (document.getElementById("<?php echo $data['jenis_kakitangan'] ?>"))
        document.getElementById("<?php echo $data['jenis_kakitangan'] ?>").checked = true;
    if (document.getElementById("<?php echo $data['jenis_processor'] ?>"))
        document.getElementById("<?php echo $data['jenis_processor'] ?>").checked = true;
    else {
        document.getElementById("otherProcRadio").checked = true;
        document.getElementById("otherProcRadio").value = "<?php echo $data['jenis_processor'] ?>";
        document.getElementById("otherProcTxtBox").value = "<?php echo $data['jenis_processor'] ?>";
        document.getElementById("otherProcTxtBox").removeAttribute("disabled");
    }
    document.getElementById("ram_<?php echo $data['saiz_ram'] ?>").selected = true;
    if (document.getElementById("<?php echo $data['jenis_sistem'] ?>"))
        document.getElementById("<?php echo $data['jenis_sistem'] ?>").checked = true;
</script>
<?php include('layout/footer.php'); ?>