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

    // Set headers
    $sheet->setCellValue('A1', 'Colour');
    $sheet->setCellValue('B1', 'Model');
    $sheet->setCellValue('C1', 'Year');

    // Populate data
    $rowNum = 2;
    foreach ($data as $row) {
        $sheet->setCellValue("A$rowNum", $row['Colour']);
        $sheet->setCellValue("B$rowNum", $row['Model']);
        $sheet->setCellValue("C$rowNum", $row['Year']);
        $rowNum++;
    }

    $sheetIndex++;
}

// Generate Excel File
$writer = new Xlsx($spreadsheet);
$fileName = "departments.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
$writer->save("php://output");

$conn->close();
?>
