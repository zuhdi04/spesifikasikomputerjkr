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
    <title>SPESIFIKASI KOMPUTER JKR KEDAH</title>

    <link rel="stylesheet" href="css/mystyle.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>


</head>

<body>
    <div class="top-bar">
        <img class="icon" src="img/logo.png" alt="Avatar" class="avatar" width="100px" height="100px">
        <h3 class="title">JABATAN KERJA RAYA NEGERI KEDAH DARUL AMAN</h3>
        <!-- <a onclick="sessionStorage.removeItem('j_Tab');alert('You are going to logout');" class="logout" href="login.html">Logout</a> -->
        <a onclick="if(confirm('You are about to be logout'))sessionStorage.removeItem('j_Tab');else return false;"
            class="logout" href="<?php echo $pages->account->logout ?>">Logout</a>
    </div>

    <!-- Navigation Menu -->
    <nav class="menu-bar">
        <ul>
            <li><a href="<?php echo $pages->spesifikasi->index ?>" class="active">Spesifikasi</a></li>
        </ul>
    </nav>

    <?php
    // show notify
    echo $notify_text;
    ?>