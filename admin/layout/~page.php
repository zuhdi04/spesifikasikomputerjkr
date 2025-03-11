<?php
$title = "";
require '../valid.php';

// include '../db_connect.php';

// POST
if($request_method === "POST"){
    echo 'posted!';
    header("Location: ".$_SERVER['PHP_SELF']);
}
?>

<?php
// GET
include '../layout/header.php';
include '../layout/content'; // add content
include '../layout/footer.php';
?>
