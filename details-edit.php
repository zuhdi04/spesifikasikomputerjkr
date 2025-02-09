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

$sql = "SELECT * FROM pc WHERE pcID=?";
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
            <h3 class="title">JABATAN KERJA RAYA NEGERI KEDAH DARUL AMAN</h3>
        </div>
        <div>
            <a href="STAFF-computer_details.html" class="btnBack">Back</a>
            <a onclick="if(confirm('You are about to be logout'))sessionStorage.removeItem('j_Tab');else return false;"
                class="logout" href="login.html">Logout</a>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="menu-bar">
        <ul>
            <li><a href="STAFF-computer_details.html">Spesifikasi</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="content">
        <h1>SPESIFIKASI KOMPUTER KAKITANGAN JKR KEDAH BAHAGIAN/CAWANGAN/UNIT/DAERAH: <span id="nama_bahagian">UNIT
        PENTADBIRAN & KEWANGAN</span></h1>

        <!-- Form Section -->
        <form id="editdetailsform" method="POST" action="editList.php" class="form-container">
            <input type="text" name="id" value="<?php echo $data['pcID']; ?>" hidden>
            <label for="fullname">Nama Penuh:</label>
            <input type="text" name="NamaPenuh" id="fullname" placeholder="Masukkan nama penuh" value="<?php echo $data['nama_penuh']; ?>" required>

            <label for="bahagian" hidden>Bahagian / Cawangan / Daerah:</label>
            <input type="text" name="bahagian" id="bahagian" placeholder="Bahagian atau daerah" value="" hidden>

            <label for="jawatangred">Jawatan dan Gred:</label>
            <input type="text" name="jawatangred" id="jawatangred" placeholder="Jawatan dan gred" value="<?php echo $data['jawatan_gred']; ?>">

            <!-- <label for="kakitangan">Kakitangan Persekutuan / Negeri:</label>
            <select name="kakitangan" id="kakitangan">
                <option id="PC NEGERI" value="PC NEGERI">PC Negeri</option>
                <option id="PC PERSEKUTUAN" value="PC PERSEKUTUAN">PC Persekutuan</option>
            </select> -->
            <label>Kakitangan Persekutuan / Negeri:</label>
            <div class="radio-group">
                <input type="radio" name="kakitangan" value="NEGERI" id="NEGERI"><label for="negeri">Negeri</label>
                <input type="radio" name="kakitangan" value="PERSEKUTUAN" id="PERSEKUTUAN"><label for="persekutuan">Persekutuan</label>
            </div>

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

    <script>document.getElementById("<?php echo $data['jenis_kakitangan'] ?>").checked=true;</script>
    <script>document.getElementById("<?php echo $data['jenis_processor'] ?>").checked=true;</script>
    <script>document.getElementById("ram_<?php echo $data['saiz_ram'] ?>").selected=true;</script>
    <script>document.getElementById("<?php echo $data['jenis_sistem'] ?>").checked=true;</script>
    <script src="js/pagecookie.js"></script>
    <script>
        let j_Tab = getCookie("j_Tab");
        deleteCookie("j_Tab");

        // #use unique value checkup
        if (j_Tab != "") { // directed from login.html / cookie
            validateUser(j_Tab);

            // $("head").val(j_Tab);
            // history.replaceState(j_Tab,"");
        }
        else if (sessionStorage.getItem("j_Tab") != null) {
            validateUser(sessionStorage.getItem("j_Tab"));
        }
        else {
            location.href = "login.html";
        }
        function validateUser(target) {
            $.ajax({
                url: 'checkUnit.php?t=' + target, // Replace with your API endpoint
                success: function (response) {
                    if (response) { // use "response" for single variable 
                        // or use "item = JSON.parse(response)" for multiple variable
                        // let item =  JSON.parse(response);

                        $(("body")).removeAttr("hidden");
                        sessionStorage.setItem("j_Tab", target);
                        details(target);
                    }
                    else {
                    }
                },

                error: function (jqXHR, textStatus, errorThrown) {
                    // document.getElementById('username').innerHTML="";
                }
            });
        }

        $.ajax({
            url: 'getUnitName.php?u=' + sessionStorage.getItem('j_Tab'), // Replace with your API endpoint
            success: function (response) {
                if (response) { // use "response" for single variable 
                    // or use "item = JSON.parse(response)" for multiple variable
                    // let item =  JSON.parse(response);
                    $("#nama_bahagian").html(response);
                    
                }
                else {
                }
            },

            error: function (jqXHR, textStatus, errorThrown) {
                // document.getElementById('username').innerHTML="";
            }
        });
    </script>
</body>

</html>