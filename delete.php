<?php
require 'validate_acc.php';

$target = $_POST['delete'];
$stmt = $conn->prepare("DELETE FROM pc WHERE pcID=?");
$stmt ->bind_param("i", $target);
if ($stmt->execute()) {
    $_SESSION['notification'] = 'Delete successful';
    echo json_encode(['message' => 'Delete successful']);
} else {
    echo json_encode(['message' => 'Delete failed: ' . $stmt->error]);
}
$stmt->close();
$conn->close();

header("Location: ".$pages->main->url);
exit;
?>