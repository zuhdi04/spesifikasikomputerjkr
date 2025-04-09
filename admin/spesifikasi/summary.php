<?php
require '../../vendor/autoload.php'; // Include PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Database connection
require '../../db_connect.php';

//jenis pc
//tahun komputer
//komputer
//processor
//ram
//sistem
//antivirus

// Fetch data grouped by department
// $query = "SELECT Department, Colour, Model, Year FROM pc"; // Change to your actual table
$query = "SELECT jenis_komputer, umur_komputer, jenis_kakitangan, jenis_processor, saiz_ram, jenis_sistem, antivirus, unit.nama FROM pc LEFT JOIN unit ON pc.unitID = unit.unitID";
$result = $conn->query($query);

$departmentData = [];
while ($row = $result->fetch_assoc()) {
    $department = $row['nama'];
    if (!isset($departmentData[$department])) {
        $departmentData[$department] = [];
    }
    $departmentData[$department][] = $row;
}

// Create Spreadsheet
$spreadsheet = new Spreadsheet();
$sheetIndex = 0;

foreach ($departmentData as $department => $data) {
    if ($sheetIndex == 0) {
        $sheet = $spreadsheet->getActiveSheet();
    } else {
        $sheet = $spreadsheet->createSheet();
    }
    $sheet->setTitle($department);

    // Count occurrences
    $jenis_komputer_Count = [];
    $umur_komputer_Count = [];
    $jenis_kakitangan_Count = [];
    $jenis_processor_Count = [];
    $saiz_ram_Count = [];
    $jenis_sistem_Count = [];
    $antivirus_Count = [];

    foreach ($data as $row) {
        $jenis_komputer_Count[$row['jenis_komputer']] = ($jenis_komputer_Count[$row['jenis_komputer']] ?? 0) + ($row['jenis_komputer'] !== "" ? 1 : 0);
        $umur_komputer_Count[$row['umur_komputer']] = ($umur_komputer_Count[$row['umur_komputer']] ?? 0) + ($row['umur_komputer'] !== "" ? 1 : 0);
        $jenis_kakitangan_Count[$row['jenis_kakitangan']] = ($jenis_kakitangan_Count[$row['jenis_kakitangan']] ?? 0) + ($row['jenis_kakitangan'] !== "" ? 1 : 0);
        $jenis_processor_Count[$row['jenis_processor']] = ($jenis_processor_Count[$row['jenis_processor']] ?? 0) + ($row['jenis_processor'] !== "" ? 1 : 0);
        $saiz_ram_Count[$row['saiz_ram']] = ($saiz_ram_Count[$row['saiz_ram']] ?? 0) + ($row['saiz_ram'] !== "" ? 1 : 0);
        $jenis_sistem_Count[$row['jenis_sistem']] = ($jenis_sistem_Count[$row['jenis_sistem']] ?? 0) + ($row['jenis_sistem'] !== "" ? 1 : 0);
        $antivirus_Count[$row['antivirus']] = ($antivirus_Count[$row['antivirus']] ?? 0) + ($row['antivirus'] !== "" ? 1 : 0);
        
        // if($row['jenis_komputer'] != "")
        // $jenis_komputer_Count[$row['jenis_komputer']] = isset($jenis_komputer_Count[$row['jenis_komputer']]) ? $jenis_komputer_Count[$row['jenis_komputer']] + 1 : 1;
        // if($row['umur_komputer'] != "")
        // $umur_komputer_Count[$row['umur_komputer']] = isset($tahunCount[$row['umur_komputer']]) ? $tahunCount[$row['umur_komputer']] + 1 : 1;
        // if($row['jenis_kakitangan'] != "")
        // $jenis_kakitangan_Count[$row['jenis_kakitangan']] = isset($kakitanganCount[$row['jenis_kakitangan']]) ? $kakitanganCount[$row['jenis_kakitangan']] + 1 : 1;
        // if($row['jenis_processor'] != "")
        // $jenis_processor_Count[$row['jenis_processor']] = isset($processorCount[$row['jenis_processor']]) ? $processorCount[$row['jenis_processor']] + 1 : 1;
        // if($row['saiz_ram'] != "")
        // $saiz_ram_Count[$row['saiz_ram']] = isset($ramCount[$row['saiz_ram']]) ? $ramCount[$row['saiz_ram']] + 1 : 1;
        // if($row['jenis_sistem'] != "")
        // $jenis_sistem_Count[$row['jenis_sistem']] = isset($sistemCount[$row['jenis_sistem']]) ? $sistemCount[$row['jenis_sistem']] + 1 : 1;
        // if($row['antivirus'] != "")
        // $antivirus_Count[$row['antivirus']] = isset($antivirusCount[$row['antivirus']]) ? $antivirusCount[$row['antivirus']] + 1 : 1;
    }

    // Set headers
    $sheet->setCellValue('G2', 'SPESIFIKASI KOMPUTER KAKITANGAN JKR NEGERI KEDAH');
    $sheet->setCellValue('G4', 'BAHAGIAN/CAWANGAN/DAERAH/UNIT : '.$department);
    $sheet->setCellValue('B7', 'JENIS PC :');
    $sheet->setCellValue('B8', 'TAHUN KOMPUTER DIGUNAKAN :');
    $sheet->setCellValue('B9', 'KOMPUTER : NEGERI / PERSEKUTUAN');
    $sheet->setCellValue('B10', 'PROCESSOR :');
    $sheet->setCellValue('B11', 'RAM :');
    $sheet->setCellValue('B12', 'SYSTEM TYPE :');
    $sheet->setCellValue('B13', 'ANTIVIRUS :');
    
    $startingCol = 'C';
    $rowNum = 7;
    $ColNum = $startingCol;
    foreach ($jenis_komputer_Count as $item => $count) {
        if($count > 0)
        $sheet->setCellValue("$ColNum$rowNum", "$item ($count)");
        $ColNum++;
        // $a1 .= "$colour ($count) ";
    }
    $rowNum++;
    $ColNum = $startingCol;
    foreach ($umur_komputer_Count as $item => $count) {
        if($count > 0)
        $sheet->setCellValue("$ColNum$rowNum", "$item ($count)");
        $ColNum++;
        // $a1 .= "$colour ($count) ";
    }
    $rowNum++;
    $ColNum = $startingCol;
    foreach ($jenis_kakitangan_Count as $item => $count) {
        if($count > 0)
        $sheet->setCellValue("$ColNum$rowNum", "$item ($count)");
        $ColNum++;
        // $a1 .= "$colour ($count) ";
    }
    $rowNum++;
    $ColNum = $startingCol;
    foreach ($jenis_processor_Count as $item => $count) {
        if($count > 0)
        $sheet->setCellValue("$ColNum$rowNum", "$item ($count)");
        $ColNum++;
        // $a1 .= "$colour ($count) ";
    }
    $rowNum++;
    $ColNum = $startingCol;
    foreach ($saiz_ram_Count as $item => $count) {
        if($count > 0)
        $sheet->setCellValue("$ColNum$rowNum", "$item GB ($count)");
        $ColNum++;
        // $a1 .= "$colour ($count) ";
    }
    $rowNum++;
    $ColNum = $startingCol;
    foreach ($jenis_sistem_Count as $item => $count) {
        if($count > 0)
        $sheet->setCellValue("$ColNum$rowNum", "$item ($count)");
        $ColNum++;
        // $a1 .= "$colour ($count) ";
    }
    $rowNum++;
    $ColNum = $startingCol;
    foreach ($antivirus_Count as $item => $count) {
        if($count > 0)
        $sheet->setCellValue("$ColNum$rowNum", "$item ($count)");
        $ColNum++;
        // $a1 .= "$colour ($count) ";
    }
    // $rowNum++;
    // $sheet->setCellValue("B1", $a1);
    
    // // $a2 = "";
    // $ColNum = 'B';
    // foreach ($modelCount as $model => $count) {
    //     $sheet->setCellValue("$ColNum"."4", "$model ($count)");
    //     $ColNum++;
    //     // $a2 .= "$model ($count) ";
    // }
    // // $sheet->setCellValue("B2", $a2);
    
    // // $a3 = "";
    // $ColNum = 'B';
    // foreach ($yearCount as $year => $count) {
    //     $sheet->setCellValue("$ColNum"."3", "$year ($count)");
    //     $ColNum++;
    //     // $a3 .= "$year ($count) ";
    // }
    // $sheet->setCellValue("B3", $a3);
    // $sheet->setCellValue("A1", $a1);
    // $sheet->setCellValue("A2", $a2);
    // $sheet->setCellValue("A3", $a3);
    // // Populate data
    // $rowNum = 2;
    // foreach ($data as $row) {
    //     $sheet->setCellValue("$rowNum"."1", $row['Colour']);
    //     $sheet->setCellValue("$rowNum"."2", $row['Model']);
    //     $sheet->setCellValue("$rowNum"."3", $row['Year']);
    //     $rowNum++;
    // }

    $sheetIndex++;
}

// Generate Excel File
$writer = new Xlsx($spreadsheet);
$fileName = "mysheets.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
$writer->save("php://output");

$conn->close();
?>