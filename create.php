<?php
$title = "";
require 'valid.php';

// POST
if ($request_method === "POST") {
    $bahagian = $_SESSION['j_Tab'];
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


?>

<?php include('layout/header.php'); ?>

<div class="content">
    <!-- Form Section -->
    <form id="detailsform" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"
        class="form-container">
        <input id="targetid" type="text" name="id" hidden>
        <label for="fullname">Nama Penuh:</label>
        <input type="text" name="NamaPenuh" id="fullname" placeholder="Masukkan nama penuh" required autofocus>

        <label for="bahagian" hidden>Bahagian / Cawangan / Daerah:</label>
        <input type="text" name="bahagian" id="bahagian" placeholder="Bahagian atau daerah" hidden>

        <label for="jawatangred">Jawatan dan Gred:</label>
        <input type="text" name="jawatangred" id="jawatangred" placeholder="Jawatan dan gred">

        <!-- <label for="kakitangan">Kakitangan Persekutuan / Negeri:</label>
    <select name="kakitangan" id="kakitangan">
        <option value="NEGERI">Negeri</option>
        <option value="PERSEKUTUAN">Persekutuan</option>
    </select> -->
        <label>Kakitangan Persekutuan / Negeri:</label>
        <div class="radio-group">
            <input type="radio" name="kakitangan" value="NEGERI" id="negeri"><label for="negeri">Negeri</label>
            <input type="radio" name="kakitangan" value="PERSEKUTUAN" id="persekutuan"><label
                for="persekutuan">Persekutuan</label>
        </div>

        <label for="jenispc">Jenis Komputer:</label>
        <input type="text" name="jenispc" id="jenispc" placeholder="Jenis komputer">

        <label for="tahun">Umur Komputer (Tahun):</label>
        <input type="number" name="tahun" id="tahun" placeholder="Umur komputer">

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
            <option value="2">2 GB</option>
            <option value="4">4 GB</option>
            <option value="6">6 GB</option>
            <option value="8">8 GB</option>
        </select>

        <label>System Type:</label>
        <div class="radio-group">
            <input type="radio" name="systemtype" value="32BIT" id="32bit"><label for="32bit">32 BIT</label>
            <input type="radio" name="systemtype" value="64BIT" id="64bit"><label for="64bit">64 BIT</label>
        </div>

        <label for="antivirus">Antivirus:</label>
        <input type="text" name="antivirus" id="antivirus" placeholder="Antivirus digunakan">

        <label for="ipaddress">IPv4 Address:</label>
        <input type="text" name="ipaddress" id="ipaddress" placeholder="Contoh: 192.168.0.1">

        <label for="catatan">Catatan:</label>
        <textarea name="catatan" id="catatan" placeholder="Tambahan informasi"></textarea>

        <input name="SAVE" class="button" type="submit" value="SAVE">
        <input type="reset" class="reset" type="reset" value="RESET">
    </form>
</div>

<?php include('layout/footer.php'); ?>