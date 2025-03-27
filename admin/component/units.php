<?php
include '../db_connect.php';
$stmt = $conn->prepare("SELECT nama,unitID FROM unit ORDER BY nama");
$stmt->execute();
$result = $stmt->get_result();
$units = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

// <?=$row['month'] == 'January' ? ' selected="selected"' : '';

// foreach ($units as $x => $y) {
//     $unit = $y['nama'];
//     echo '<option value="' . $unit . '">' . $unit . '</option>';
// }
$selectedunit = isset($data['unitID']) ? htmlspecialchars($data['unitID']) : -1 ;
foreach ($units as $x => $unit):
?>
<option value="<?=$unit['nama']?>" <?=$selectedunit == $unit['unitID'] ? 'selected="selected"' : ''?>><?=$unit['nama']?></option>
<?php endforeach; ?>