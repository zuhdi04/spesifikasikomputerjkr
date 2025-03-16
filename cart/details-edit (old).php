<!DOCTYPE html>
<html lang="en">

<?php
$id = $_GET['form'];

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

$sql = "SELECT * FROM pc WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_array(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
echo json_encode($data);
?>

<head>
    <meta charset="utf-8" />
    <title>Edit - ZSMS</title>
    <link rel="stylesheet" href="css/mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</head>

<body>
    <div class="top-bar">
        <img class="icon" src="img/logo.png" alt="Avatar" class="avatar" width="100px" height="100px">
        <a onclick="alert('You are going to logout')" class="logout" href="login.html">Logout</a>
    </div>

    <!-- Navigation Menu -->
    <nav class="menu-bar">
        <ul>
            <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="details.html">Details</a></li>
        </ul>
    </nav>

    <div class="content">
        <a href="details.html">Back</a>
        <h1>SPESIFIKASI KOMPUTER KAKITANGAN JKR KEDAH BAHAGIAN/UNIT/DAERAH: UNIT PENTADBIRAN&KEWANGAN</h1>
        <form method="POST" action="">
            <label for="fullname">NAMA PENUH:</label><input type="text" name="Nama Penuh" id="fullname"
                value="<?php echo $data['nama_penuh']; ?>" required><br>
            <label for="second">BAHAGIAN / CAWANGAN / DAERAH:</label><input type="text" name="" id="second"
                value="<?php echo $data['bahagian_cawangan_daerah']; ?>"><br>
            <label for="third">JAWATAN DAN GRED:</label><input type="text" name="jawatangred" id="third"
                value="<?php echo $data['jawatan_gred']; ?>"><br>
            <label for="kakitangan">KAKITANGAN PERSEKUTUAN / NEGERI:</label>
            <select name="kakitangan" id="kakitangan">
                <option id="PC NEGERI" value="PC NEGERI">PC NEGERI</option>
                <option id="PC PERSEKUTUAN" value="PC PERSEKUTUAN">PC PERSEKUTUAN</option>
            </select><br>
            <label for="fifth">JENIS KOMPUTER: PERSEKUTUAN / SUK / PROJEK</label><input type="text" name="jenispc"
                id="fifth" value="<?php echo $data['jenis_komputer']; ?>"><br>
            <label for="pcage">UMUR KOMPUTER:</label><input type="text" name="" id="pcage"
                value="<?php echo $data['umur_komputer']; ?>">TAHUN<br>
            JENIS PROCESSOR:
            <input id="i3" type="radio" name="proc" value="i3">i3
            <input id="i5" type="radio" name="proc" value="i5">i5
            <input id="i7" type="radio" name="proc" value="i7">i7
            <input id="OTHERS" type="radio" name="proc" value="OTHERS">OTHERS:<input type="text" name=""
                id="otherProcTxtBox" disabled><br>
            <label for="ram">RAM:</label>
            <select name="ram" id="ram">
                <option id="ram_2" value="2">2</option>
                <option id="ram_4" value="4">4</option>
                <option id="ram_6" value="6">6</option>
                <option id="ram_8" value="8">8</option>
            </select>GB<br>
            SYSTEM TYPE:
            <input type="radio" name="systemtype" id="32BIT" value="32BIT">32 BIT
            <input type="radio" name="systemtype" id="64BIT" value="64BIT">64 BIT<br>
            <label for="antivirus">ANTIVIRUS:</label><input type="text" name="antivirus" id="antivirus"
                value="<?php echo $data['antivirus']; ?>"><br>
            <label for="ipaddress">IPV4 ADDRESS:</label><input type="text" name="ipaddress" id="ipaddress"
                value="<?php echo $data['ipv4_address']; ?>"><br>
            <label for="catatan">CATATAN:</label><input type="text" name="catatan" id="catatan"
                value="<?php echo $data['catatan']; ?>"><br>
            <button id="editStaffBtn">Save</button>
        </form>
        <button>Before</button>
        <button>Next</button>
    </div>
    <script>document.getElementById("<?php echo $data['jenis_kakitangan'] ?>").selected = true;</script>
    <script>document.getElementById("<?php echo $data['jenis_processor'] ?>").checked = true;</script>
    <script>document.getElementById("ram_<?php echo $data['saiz_ram'] ?>").selected = true;</script>
    <script>document.getElementById("<?php echo $data['jenis_sistem'] ?>").checked = true;</script>
</body>

</html>