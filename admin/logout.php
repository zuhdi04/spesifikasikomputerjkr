<?php
session_start();
$_SESSION['j_Tab_admin'] = null;
header("Location: ../login");
exit;

?>