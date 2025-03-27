<?php
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

// Fetch data from database
$query = "SELECT Colour, Model, Year FROM products"; // Change your_table to your actual table name
$result = $conn->query($query);

// Count occurrences
$colourCount = [];
$modelCount = [];
$yearCount = [];

while ($row = $result->fetch_assoc()) {
    $colourCount[$row['Colour']] = isset($colourCount[$row['Colour']]) ? $colourCount[$row['Colour']] + 1 : 1;
    $modelCount[$row['Model']] = isset($modelCount[$row['Model']]) ? $modelCount[$row['Model']] + 1 : 1;
    $yearCount[$row['Year']] = isset($yearCount[$row['Year']]) ? $yearCount[$row['Year']] + 1 : 1;
}

// Load PHPExcel Library
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=export.xlsx");
header("Pragma: no-cache");
header("Expires: 0");

// Output table structure
echo "<table border='1'>";
echo "<tr><th>Data</th><th>Amount</th></tr>";

// Output Colour data
echo "<tr><td>Colour:</td><td>";
foreach ($colourCount as $colour => $count) {
    echo "$colour ($count) ";
}
echo "</td></tr>";

// Output Model data
echo "<tr><td>Model:</td><td>";
foreach ($modelCount as $model => $count) {
    echo "$model ($count) ";
}
echo "</td></tr>";

// Output Year data
echo "<tr><td>Year:</td><td>";
foreach ($yearCount as $year => $count) {
    echo "$year ($count) ";
}
echo "</td></tr>";

echo "</table>";

// Close the database connection
$conn->close();
?>
