<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "zuhdiscmsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if image is selected
    if(isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        // Get image info
        $imageName = $_FILES['gambar']['name'];
        $imageTmpName = $_FILES['gambar']['tmp_name'];
        $imageSize = $_FILES['gambar']['size'];

        // Ensure image size is reasonable (optional)
        if ($imageSize > 5000000) { // 5MB max
            echo "File is too large.";
            exit;
        }

        // Read image file into binary data
        $imageData = file_get_contents($imageTmpName); // No need for addslashes()

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO images (image_name, image_data) VALUES (?, ?)";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "Error preparing statement: " . $conn->error;
            exit;
        }

        // Bind parameters
        // "ss" means both parameters are strings (image_name is string, image_data is a string of binary data)
        $stmt->bind_param("ss", $imageName, $imageData);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Image uploaded successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "No image selected or error in upload.";
    }
}

// Close the connection
$conn->close();
?>



<!-- HTML form to upload an image -->
<form action="" method="POST" enctype="multipart/form-data">
    <label for="image">Select an image:</label>
    <input type="file" name="gambar" id="image" accept="image/*" required>
    <button type="submit">Upload Image</button>
</form>
