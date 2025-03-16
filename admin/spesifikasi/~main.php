<?php
require '../validate_acc.php';

$tab = isset($_SESSION['j_Tab']) ? $_SESSION['j_Tab'] : "";
if (isset($_SESSION['j_Tab'])) {
    $stmt = $conn->prepare("SELECT * FROM pc INNER JOIN unit ON pc.unitID=unit.id WHERE unitCode=? ORDER BY nama_penuh");
    $stmt->bind_param("s", $tab);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else
    $data = [];
$PCs = json_encode($data);

$conn->close();
?>

<?php include('../header.php'); ?>

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
        <?php foreach (json_decode($PCs) as $pc) {
            echo "<tr>
                    <td> $pc->nama_penuh </td>
                    <td> $pc->jawatan_gred </td>
                    <td> $pc->jenis_kakitangan </td>
                    <td> $pc->jenis_komputer </td>
                    <td> $pc->umur_komputer </td>
                    <td> $pc->jenis_processor </td>
                    <td> $pc->saiz_ram </td>
                    <td> $pc->jenis_sistem </td>
                    <td> $pc->antivirus </td>
                    <td> $pc->ipv4_address </td>
                    <td> $pc->catatan </td>
                    <td><a href='" . $pages->edit->url . "?form=$pc->pcID '>Edit</a>
                    <a href='delete' class='delete_details' data-nama=' $pc->nama_penuh' data-id=' $pc->pcID' onclick='return false;'><form hidden id='deleteForm' action='" . $pages->delete->url . "' method='POST'><input type='hidden' name='delete' value='$pc->pcID'></form>Delete</a>
                    </td>
                </tr>";
        }
        ?>
        <!-- <tr>
            <td>1</td>
        </tr> -->
    </tbody>
</table>
<!-- </div> -->
<a id="tambahButton" href="<?php echo $pages->create->url ?>" class="btnAdd">Tambah maklumat</a>

<script>
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

<?php include('../footer.php'); ?>