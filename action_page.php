<?php
if (isset($_POST["signin"])) {
    // User input
    $cookie_name = "user";
    // $email1 = $_POST['loginemail'];
    // $email = strval($email1); // Ensure $email is a string
    $key = $_POST['psw']; // The plain text password entered by the user

    // MySQL database connection
    $con = new mysqli('localhost', 'root', '', 'scmsdb');
    
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare SQL query using prepared statements
    $sql = "SELECT id,username, membership, birthday, phone, email, pass FROM customer_account WHERE email = ?";
    
    // Prepare the statement
    if ($stmt = $con->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("s", $email); // "s" indicates the parameter is a string

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are any matching rows
        if ($result && $result->num_rows > 0) {
            // Fetch the result as an associative array
            $row = $result->fetch_array(MYSQLI_ASSOC);

            // Verify the password using password_verify() function
            if (password_verify($key, $row['pass'])) {
                // Password is correct, store user data in cookies and redirect
                setcookie($cookie_name, $row['username'], time() + (86400 * 30 * 30), "/");
                setcookie("user_id", $row['id'], time() + (86400 * 30 * 30), "/");
                setcookie("phone", $row['phone'], time() + (86400 * 30 * 30), "/");
                setcookie("membership", $row['membership'], time() + (86400 * 30 * 30), "/");
                setcookie("birthday", $row['birthday'], time() + (86400 * 30 * 30), "/");
                setcookie("email", $email, time() + (86400 * 30 * 30), "/");

                // Redirect to the homepage after login
                $stmt->close();
                $con->close();
                header("Location: ..");
                exit;
            } else {
                // Invalid password
                setcookie("error", "default", time() + (30 * 30), "/");
            }
        } else {
            // Handle login failure (e.g., wrong email)
            setcookie("error", "default", time() + (86400 * 30), "/");
            // echo "No results found or query error!";
        }

        // Close the statement
        $stmt->close();
    } else {
        // If statement preparation fails, print error
        // echo "Error preparing the query: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>