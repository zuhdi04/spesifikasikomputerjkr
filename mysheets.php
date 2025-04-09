<?php
require 'vendor/autoload.php'; // Include PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Database connection
$servername = "localhost";
$username = "root"; // Change if necessary
$password = "";
$database = "zuhdiscmsdb"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data grouped by department
$query = "SELECT Department, Colour, Model, Year FROM products"; // Change to your actual table
$result = $conn->query($query);

$departmentData = [];
while ($row = $result->fetch_assoc()) {
    $department = $row['Department'];
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
    $colourCount = [];
    $modelCount = [];
    $yearCount = [];

    foreach ($data as $row) {
        $colourCount[$row['Colour']] = isset($colourCount[$row['Colour']]) ? $colourCount[$row['Colour']] + 1 : 1;
        $modelCount[$row['Model']] = isset($modelCount[$row['Model']]) ? $modelCount[$row['Model']] + 1 : 1;
        $yearCount[$row['Year']] = isset($yearCount[$row['Year']]) ? $yearCount[$row['Year']] + 1 : 1;
    }

    // Set headers
    $sheet->setCellValue('A1', 'Colour');
    $sheet->setCellValue('A2', 'Model');
    $sheet->setCellValue('A3', 'Year');
    
    // $a1 = "";
    $ColNum = 'B';
    foreach ($colourCount as $colour => $count) {
        $sheet->setCellValue("$ColNum"."1", "$colour ($count)");
        $ColNum++;
        // $a1 .= "$colour ($count) ";
    }
    // $sheet->setCellValue("B1", $a1);
    
    // $a2 = "";
    $ColNum = 'B';
    foreach ($modelCount as $model => $count) {
        $sheet->setCellValue("$ColNum"."2", "$model ($count)");
        $ColNum++;
        // $a2 .= "$model ($count) ";
    }
    // $sheet->setCellValue("B2", $a2);
    
    // $a3 = "";
    $ColNum = 'B';
    foreach ($yearCount as $year => $count) {
        $sheet->setCellValue("$ColNum"."3", "$year ($count)");
        $ColNum++;
        // $a3 .= "$year ($count) ";
    }
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
