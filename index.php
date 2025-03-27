<?php
require 'valid.php';

$tab = isset($_SESSION['j_Tab']) ? $_SESSION['j_Tab'] : "";
if ($tab != "") {
    include 'db_connect.php';
    $stmt = $conn->prepare("SELECT * FROM pc INNER JOIN unit ON pc.unitID=unit.unitID WHERE code=? ORDER BY nama_penuh");
    $stmt->bind_param("s", $tab);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
} else
    $data = [];
$PCs = json_encode($data);
?>

<?php include('layout/header.php'); ?>

<div class="content1">
    <h1>SPESIFIKASI KOMPUTER KAKITANGAN:
        <?php echo $unit_name ?>
    </h1>
    <!-- <span id="nama_bahagian">UNIT PENTADBIRAN & KEWANGAN</span></h1> -->
    <?php include 'component/spesifikasitable.php'; ?>
    <br>
    <a id="tambahButton" href="<?php echo $pages->spesifikasi->create ?>" class="btnAdd">Tambah Maklumat</a>
    <br><br>
    <h1>Generate Excel from Database</h1>
    <form action="generate_excel.php" method="post">
        <button type="submit" name="generate_excel">Generate Excel</button>
    </form>

    <script>
        $('#printTable').DataTable();
        
        $('#printTable').on('click', '.delete_details', function () {
            
            let n = $(this).data('nama');
            
            if (confirm("Adakah anda mahu memadam maklumat: " + n + "?")) {
                $(this).children().submit();
            }
        });
    </script>

<?php include('layout/footer.php'); ?>