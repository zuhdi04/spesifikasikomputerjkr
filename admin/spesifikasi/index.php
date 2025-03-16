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
    <div style="overflow-x:auto;">
    <table id="printTable" class="display" border="display">
        <thead>
            <tr>
                <th>NAMA PENUH</th>
                <th>CAWANGAN/ DAERAH/ UNIT/ BAHAGIAN</th>
                <th>JAWATAN DAN GRED</th>
                <th>KAKITANGAN PERSEKUTUAN/ NEGERI</th>
                <th>JENIS KOMPUTER: PERSEKUTUAN/ SUK/ PROJEK</th>
                <th>UMUR KOMPUTER</th>
                <th>JENIS PROCESSOR: i3/i5/i7</th>
                <th>RAM: 2GB/ 4GB/ 6GB/ 8GB</th>
                <th>SYSTEM TYPE: 32BIT/64BIT</th>
                <th>ANTIVIRUS</th>
                <th>IPV4 ADDRESS</th>
                <th>CATATAN</th>
                <th>OPERASI</th>
            </tr>
        </thead>
        <tbody id="computerlist">
            <?php foreach (json_decode($PCs) as $pc): ?>

                <tr>
                    <td><?php echo $pc->nama_penuh ?></td>
                    <td><?php echo $pc->nama ?></td>
                    <td><?php echo $pc->jawatan_gred ?></td>
                    <td><?php echo $pc->jenis_kakitangan ?></td>
                    <td><?php echo $pc->jenis_komputer ?></td>
                    <td><?php echo $pc->umur_komputer ?></td>
                    <td><?php echo $pc->jenis_processor ?></td>
                    <td><?php echo $pc->saiz_ram ?></td>
                    <td><?php echo $pc->jenis_sistem ?></td>
                    <td><?php echo $pc->antivirus ?></td>
                    <td><?php echo $pc->ipv4_address ?></td>
                    <td><?php echo $pc->catatan ?></td>
                    <td><a href="<?php echo $pages->spesifikasi->edit ?>?form=<?php echo $pc->pcID ?>">Edit</a><br><br>
                        <a href="delete" class="delete_details" data-nama="<?php echo $pc->nama_penuh ?>"
                            data-id="<?php echo $pc->pcID ?>" onclick="return false;">
                            <form hidden id="deleteForm" action="<?php echo $pages->spesifikasi->delete ?>" method="POST">
                                <input type="hidden" name="delete" value="<?php echo $pc->pcID ?>"></form>Delete
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>
            <!-- <tr>
            <td>1</td>
        </tr> -->
        </tbody>
    </table>
    </div>
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