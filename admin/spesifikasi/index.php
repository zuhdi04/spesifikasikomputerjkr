<?php
require '../valid.php';

include '../db_connect.php';
$stmt = $conn->prepare("SELECT * FROM pc INNER JOIN unit ON pc.unitID=unit.id ORDER BY nama_penuh");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
$PCs = json_encode($data);

?>

<?php include('../layout/header.php'); ?>
<div class="content1">
    <h1>SPESIFIKASI KOMPUTER KAKITANGAN JKR KEDAH</h1>
    <br>
    <div>
        <label for="unit">CAWANGAN/ DAERAH/ UNIT/ BAHAGIAN:</label><br>
        <select name="unit_select" id="unit_select">
            <option></option>
            <?php include '../component/units.php'; ?>
        </select>
    </div>
    <?php include '../../component/spesifikasitable.php'; ?>
    <br>
    <a id="tambahButton" href="<?php echo $pages->spesifikasi->create ?>" class="btnAdd">Tambah Maklumat</a>
</div>

<script>
    $('#printTable').DataTable();

    $('#printTable').on('click', '.delete_details', function () {
        let n = $(this).data('nama');

        if (confirm("Adakah anda mahu memadam maklumat: " + n + "?")) {
            $(this).children().submit();
        }
    });

    if (location.hash != "") {
        const kategori = location.hash.slice(1);// unit_select
        const target_kategori = "unit_".concat(kategori);
        document.getElementById(target_kategori).selected = true;
        select_kategori();
    }

    $('select').on("change", function () {
        select_kategori();
    })

    function select_kategori() {
        const selectedUnit = $('select option:selected').html();
        const table = new DataTable('#printTable');
        table.search(selectedUnit).draw();
    }
</script>

<?php include('../layout/footer.php'); ?>