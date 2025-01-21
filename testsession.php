<?php
session_start();
echo json_encode(['message' => $_SESSION['testsession']]);
// header("Location: ADMIN-staff_details.html");
// exit;
?>