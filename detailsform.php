<?php
if ( isset($_POST['SAVE'])){
$fullname = $_POST["NamaPenuh"];
$bahagian = $_POST["bahagian"];
$jawatangred = $_POST["jawatangred"];
$kakitangan = $_POST["kakitangan"];
$jenispc = $_POST["jenispc"];
$tahun = $_POST["tahun"];
$proc = $_POST["proc"];
$ram = $_POST["ram"];
$antivirus = $_POST["antivirus"];
$systemtype = $_POST["systemtype"];
$ipaddress = $_POST["ipaddress"];
$catatan = $_POST["catatan"];

echo $fullname," ", $bahagian
," ", $jawatangred, " ", $kakitangan," ", $jenispc,
" ", $tahun," ", $proc," ", $ram," ", $antivirus," ", $ipaddress," ", $catatan;





}
else
header("Location: details-form.html");

?>