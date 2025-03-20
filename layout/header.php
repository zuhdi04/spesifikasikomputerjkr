<!-- includes/header.php -->
<?php
include 'db_connect.php';
$target = $_SESSION['j_Tab'];
$sql = "SELECT nama FROM unit WHERE unitCode=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $target);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($unit_name);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPESIFIKASI KOMPUTER JKR KEDAH</title>

    <link rel="stylesheet" href="css/mystyle.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>


</head>

<body>
    <div class="top-bar">
        <div class="logo-section">
            <img class="icon" src="img/logo.png" alt="Company Logo" width="100px" height="100px">
        </div>
        <div>
            <h3 class="title">JABATAN KERJA RAYA NEGERI KEDAH DARUL AMAN</h3>
        </div>
        <div>
            <?php include 'component/backbutton.php'; ?>
            <a onclick="if(confirm('You are about to be logout'))sessionStorage.removeItem('j_Tab');else return false;"
                class="logout" href="<?php echo $pages->account->logout ?>">Logout</a>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="menu-bar">
        <ul>
            <li><a href="<?php echo $pages->spesifikasi->index ?>">Spesifikasi</a></li>
            <li><a href="<?php echo $pages->spesifikasi->create ?>"> Tambah Maklumat</a></li>
        </ul>
    </nav>

    <?php
    // show notify
    echo $notify_text;
    ?>