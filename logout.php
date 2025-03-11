<?php
session_start();
$_SESSION['j_Tab'] = null;
header("Location: login");
exit;

?>