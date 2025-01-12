<!DOCTYPE html>
<html lang="en">

<?php
$id=$_GET['form'];

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$sql = "SELECT * FROM pc WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_array(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
// echo json_encode($data);
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add - ZSMS</title>
    <link rel="stylesheet" href="css/mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- Top Bar -->
    <header class="top-bar">
        <div class="logo-section">
            <img class="icon" src="img/logo.png" alt="Company Logo" width="100px" height="100px">
        </div>
        <div>
            <a href="details.html" class="btnBack">Back</a>
            <a onclick="alert('You are going to logout')" class="logout" href="login.html">Logout</a>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="menu-bar">
        <ul>
            <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="details.html">Details</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="content">
        <h1>Spesifikasi Komputer Kakitangan</h1>
        <h1>Bahagian/Unit/Daerah: Unit Pentadbiran & Kewangan</h1>

        <!-- Form Section -->
        <form id="editdetailsform" method="POST" action="editList.php" class="form-container">
            <input type="text" name="id" value="<?php echo $data['id']; ?>" hidden>
            <label for="fullname">Nama Penuh:</label>
            <input type="text" name="NamaPenuh" id="fullname" placeholder="Masukkan nama penuh" value="<?php echo $data['nama_penuh']; ?>" required>

            <label for="bahagian">Bahagian / Cawangan / Daerah:</label>
            <input type="text" name="bahagian" id="bahagian" placeholder="Bahagian atau daerah" value="<?php echo $data['bahagian_cawangan_daerah']; ?>">

            <label for="jawatangred">Jawatan dan Gred:</label>
            <input type="text" name="jawatangred" id="jawatangred" placeholder="Jawatan dan gred" value="<?php echo $data['jawatan_gred']; ?>">

            <label for="kakitangan">Kakitangan Persekutuan / Negeri:</label>
            <select name="kakitangan" id="kakitangan">
                <option id="PC NEGERI" value="PC NEGERI">PC Negeri</option>
                <option id="PC PERSEKUTUAN" value="PC PERSEKUTUAN">PC Persekutuan</option>
            </select>

            <label for="jenispc">Jenis Komputer:</label>
            <input type="text" name="jenispc" id="jenispc" placeholder="Jenis komputer" value="<?php echo $data['jenis_komputer']; ?>">

            <label for="tahun">Umur Komputer (Tahun):</label>
            <input type="number" name="tahun" id="tahun" placeholder="Umur komputer" value="<?php echo $data['umur_komputer']; ?>">

            <label>Jenis Processor:</label>
            <div class="radio-group">
                <input type="radio" name="proc" value="i3" id="i3"><label for="i3">i3</label>
                <input type="radio" name="proc" value="i5" id="i5"><label for="i5">i5</label>
                <input type="radio" name="proc" value="i7" id="i7"><label for="i7">i7</label>
                <input type="radio" name="proc" id="otherProcRadio">
                <label for="otherProcRadio">Others:</label>
                <input type="text" id="otherProcTxtBox" disabled>
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
            <input type="text" name="antivirus" id="antivirus" placeholder="Antivirus digunakan" value="<?php echo $data['antivirus']; ?>">

            <label for="ipaddress">IPv4 Address:</label>
            <input type="text" name="ipaddress" id="ipaddress" placeholder="Contoh: 192.168.0.1" value="<?php echo $data['ipv4_address']; ?>">

            <label for="catatan">Catatan:</label>
            <textarea name="catatan" id="catatan" placeholder="Tambahan informasi" value="<?php echo $data['catatan']; ?>"></textarea>

            <input name="SAVE" class="button" type="submit" value="SAVE">
            <input type="reset" class="reset" type="reset" value="RESET">
        </form>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 ZSMS. All rights reserved.</p>
    </footer>

    <script>document.getElementById("<?php echo $data['jenis_kakitangan'] ?>").selected=true;</script>
    <script>document.getElementById("<?php echo $data['jenis_processor'] ?>").checked=true;</script>
    <script>document.getElementById("ram_<?php echo $data['saiz_ram'] ?>").selected=true;</script>
    <script>document.getElementById("<?php echo $data['jenis_sistem'] ?>").checked=true;</script>
</body>

</html>