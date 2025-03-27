<?php
// Include the Composer autoload file
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['generate_excel'])) {
    // Database connection parameters
    $host = 'localhost';
    $dbname = 'zuhdiscmsdb';
    $username = 'root';
    $password = '';

    try {
        // Create PDO connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL query to fetch categorized data
        $sql = "SELECT category, name, price, quantity FROM products ORDER BY category";
        $stmt = $pdo->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Category');
        // $sheet->setCellValue('B1', 'Name');
        // $sheet->setCellValue('C1', 'Price');
        // $sheet->setCellValue('D1', 'Quantity');

        // // Start row for data
        // $row = 2;

        // // Write data to spreadsheet, categorized
        // $currentCategory = '';
        // foreach ($products as $product) {
        //     // Check if the category has changed, and add a new row for the category if so
        //     if ($product['category'] !== $currentCategory) {
        //         $currentCategory = $product['category'];
        //         $sheet->setCellValue('A' . $row, $currentCategory);
        //         $sheet->getStyle('A' . $row)->getFont()->setBold(true); // Make category bold
        //         $row++; // Move to next row
        //     }
            
        //     // Write product data
        //     $sheet->setCellValue('A' . $row, $product['category']);
        //     $sheet->setCellValue('B' . $row, $product['name']);
        //     $sheet->setCellValue('C' . $row, $product['price']);
        //     $sheet->setCellValue('D' . $row, $product['quantity']);
        //     $row++;
        // }

        // Group data by category
        $groupedData = [];
        foreach ($products as $row) {
            $groupedData[$row['category']][] = $row;
        }

        // Write each category to a separate sheet
        $sheetIndex = 0;
        foreach ($groupedData as $category => $rows) {
            $_SESSION['notify'] = ['text' => $sheetIndex ];
            $sheet = $spreadsheet->createSheet($sheetIndex);
            $sheet->setTitle($category);

            // Set headers
            $sheet->setCellValue('A1', 'Product Name');
            $sheet->setCellValue('B1', 'Price');
            $sheet->setCellValue('C1', 'Quantity');

            // Write data to sheet
            $rowIndex = 2; // Start from row 2 (after headers)
            foreach ($rows as $row) {
                $sheet->setCellValue('A' . $rowIndex, $row['name']);
                $sheet->setCellValue('B' . $rowIndex, $row['price']);
                $sheet->setCellValue('C' . $rowIndex, $row['quantity']);
                $rowIndex++;
            }

            $sheetIndex++;
        }

        // Set proper headers to prompt download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="products.xlsx"');
        header('Cache-Control: max-age=0');

        // Write the file to the browser
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
