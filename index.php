<?php
require 'valid.php';

$tab = isset($_SESSION['j_Tab'])?$_SESSION['j_Tab']:"";
if(isset($_SESSION['j_Tab'])){
    include 'db_connect.php';
    $stmt = $conn->prepare("SELECT * FROM pc INNER JOIN unit ON pc.unitID=unit.id WHERE unitCode=? ORDER BY nama_penuh");
    $stmt->bind_param("s", $tab);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
else $data=[];
$PCs = json_encode($data);

$conn->close();
?>

<?php include('layout/header.php'); ?>

<table id="printTable" class="display" border="display">
    <thead>
        <tr>
            <th>NAMA PENUH</th>
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
                <td><a href="<?php echo $pages->spesifikasi->edit ?>?form=<?php echo $pc->pcID ?>">Edit</a>
                    <a href="delete" class="delete_details" data-nama="<?php echo $pc->nama_penuh ?>" data-id="<?php echo $pc->pcID ?>" onclick="return false;">
                    <form hidden id="deleteForm" action="<?php echo $pages->spesifikasi->delete ?>" method="POST"><input type="hidden" name="delete" value="<?php echo $pc->pcID ?>"></form>Delete</a>
                </td>
            </tr>
            
        <?php endforeach; ?>
        <!-- <tr>
            <td>1</td>
        </tr> -->
    </tbody>
</table>
<!-- </div> -->
<a id="tambahButton" href="<?php echo $pages->spesifikasi->create ?>" class="btnAdd">Tambah maklumat</a>

<script>
    $('#printTable').DataTable();

    $('#printTable').on('click', '.delete_details', function () {

    // let p = $(this).data('id');
    let n = $(this).data('nama');

    if (confirm("Adakah anda mahu memadam maklumat: " + n + "?")) {
        $(this).children().submit();
        
        // Perform AJAX request
        // $.ajax({
        //     url: 'deleteList.php', // Replace with your API endpoint
        //     method: 'POST', // Use POST for updates
        //     data: {
        //         target: p
        //     },
        //     success: function (response) {
        //         // Handle successful response
        //         console.log('Update successful:', response);
        //         alert('Maklumat telah dipadam!');
        //         details(sessionStorage.getItem('j_Tab'));
        //     },
        //     error: function (jqXHR, textStatus, errorThrown) {
        //         // Handle error
        //         console.error('Update failed:', textStatus, errorThrown);
        //         alert('Error updating data.');
        //     }
        // });
    }
    });
</script>

<?php include('layout/footer.php'); ?>