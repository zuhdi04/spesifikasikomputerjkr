<!-- includes/header.php -->
<?php
// include '../db_connect.php';
// $target = $_SESSION['j_Tab'];
// $sql = "SELECT nama FROM unit WHERE unitCode=?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("s",$target);
// $stmt->execute();
// $stmt->store_result();
// $stmt->bind_result($unit_name);
// $stmt->fetch();
// $stmt->close();
// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SPESIFIKASI KOMPUTER JKR KEDAH</title>

    <link rel="stylesheet" href="../css/mystyle.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <!-- <script src="../js/script.js"></script> -->

    <style>
        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .title {
            font-size: large;
            font-weight: bold;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: rgba(240, 203, 41, 0.993);
        }

        /* Table Styling */
        #printTable {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
            background-color: #ffffff;
        }

        /* Header Styling */
        #printTable thead {
            background-color: #2c3e50;
            /* Dark blue header */
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }

        /* Table Borders */
        #printTable th,
        #printTable td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        /* Alternating Row Colors */
        #printTable tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
            /* Light gray for odd rows */
        }

        #printTable tbody tr:nth-child(even) {
            background-color: #e6f7ff;
            /* Light blue for even rows */
        }

        /* Hover Effect */
        #printTable tbody tr:hover {
            background-color: #cceeff;
            /* Brighter blue on hover */
            cursor: pointer;
        }

        /* Center Align Header */
        #printTable th {
            text-align: center;
        }

        /* Buttons inside the table */
        #staffTable a,
        #printTable a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            margin: 2px;
            font-size: 14px;
        }

        /* Edit Button */
        #staffTable a[href*='edit'],
        #printTable a[href*='edit'] {
            background-color: #28a745;
            color: white;
        }

        /* Delete Button */
        #staffTable a[href*='delete'],
        #printTable a[href*='delete'] {
            background-color: #dc3545;
            color: white;
        }

        /* Button Hover */
        #staffTable a:hover,
        #printTable a:hover {
            opacity: 0.8;
        }
    </style>

</head>

<body>
    <div class="top-bar">
        <img class="icon" src="../img/logo.png" alt="Avatar" class="avatar" width="100px" height="100px">
        <h3 class="title">JABATAN KERJA RAYA NEGERI KEDAH DARUL AMAN</h3>
        <!-- <a onclick="sessionStorage.removeItem('j_Tab');alert('You are going to logout');" class="logout" href="login.html">Logout</a> -->
        <a onclick="if(confirm('You are about to be logout')){sessionStorage.removeItem('j_Tab');}else return false;"
            class="logout" href="../<?php echo $pages->account->logout ?>">Logout</a>
    </div>

    <!-- Navigation Menu -->
    <nav class="menu-bar">
        <ul>
            <li><a href="<?php echo $pages->akaun->index ?>">Admin</a></li>
            <li><a href="<?php echo $pages->spesifikasi->index ?>">Spesifikasi</a></li>
        </ul>
    </nav>

    <?php
        // show notify
        echo $notify_text;
    ?>

    <!-- <div class="content">
        <h1>SPESIFIKASI KOMPUTER KAKITANGAN JKR KEDAH BAHAGIAN/CAWANGAN/UNIT/DAERAH: 
            <?php echo $unit_name ?></h1> -->
            <!-- <span id="nama_bahagian">UNIT PENTADBIRAN & KEWANGAN</span></h1> -->