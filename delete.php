<?php
require 'valid.php';

$target = $_POST['delete'];
include 'db_connect.php';
$stmt = $conn->prepare("DELETE FROM pc WHERE pcID=?");
$stmt->bind_param("i", $target);
if ($stmt->execute()) {
    $_SESSION["notify"] = ['text' => 'Delete successful'];
    // echo json_encode(['message' => 'Delete successful']);
} else {
    // echo json_encode(['message' => 'Delete failed: ' . $stmt->error]);
}
$stmt->close();
$conn->close();

header("Location: " . $pages->spesifikasi->index);
exit;
?>