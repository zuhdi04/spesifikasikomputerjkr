<?php
include '../db_connect.php';
$stmt = $conn->prepare("SELECT nama,id FROM unit ORDER BY nama");
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
foreach ($units as $x => $y):
?>
<option value="<?=$y['nama']?>" <?php if(isset($data)) echo $data['unitID'] == $y['id'] ? ' selected="selected"' : ''?>><?=$y['nama']?></option>
<?php endforeach; ?>