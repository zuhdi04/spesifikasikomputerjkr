<?php
require 'valid.php';

$tab = isset($_SESSION['j_Tab']) ? $_SESSION['j_Tab'] : "";
if (isset($_SESSION['j_Tab'])) {
    include 'db_connect.php';
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

<?php include('layout/header.php'); ?>

<div class="content1">
    <h1>SPESIFIKASI KOMPUTER KAKITANGAN:
        <?php echo $unit_name ?>
    </h1>
    <!-- <span id="nama_bahagian">UNIT PENTADBIRAN & KEWANGAN</span></h1> -->
    <?php include 'component/spesifikasitable.php'; ?>
    <br>
    <a id="tambahButton" href="<?php echo $pages->spesifikasi->create ?>" class="btnAdd">Tambah Maklumat</a>

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