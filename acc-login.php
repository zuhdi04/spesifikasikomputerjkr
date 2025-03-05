<?php
if (isset($_POST["signin"])) {
    // session_start();
    $username = $_POST['uname'];
    $key = $_POST['psw'];
    $remember_user = isset($_POST['remember'])?$_POST['remember']:null;
    
    // MySQL database connection
    $con = new mysqli('localhost', 'root', '', 'zuhdiscmsdb');
    
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT username,password_encrypt,unitID,unitCode FROM admin LEFT JOIN unit ON unitID=unit.id WHERE username = ?";
    // Prepare the statement
    if ($stmt = $con->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("s", $username); // "s" indicates the parameter is a string

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are any matching rows
        if ($result && $result->num_rows > 0) {
            // Fetch the result as an associative array
            $row = $result->fetch_array(MYSQLI_ASSOC);

            // Verify the password using password_verify() function
            if (password_verify($key, $row['password_encrypt'])) {
                // $_SESSION[$row['username']] = true;
                // Password is correct, store user data in cookies and redirect
                if ($remember_user!=null) ;
                // setcookie("user", $row['username'], time() + (86400 * 30 * 30), "/");

                // Redirect to the homepage after login
                $stmt->close();
                $con->close();
                if($row['unitID']===0){
                    setcookie("j_Tab", "test", time() + (30), "/");
                    header("Location: admin/ADMIN-staff_details.html");
                }
                else{
                    setcookie("j_Tab", $row['unitCode'], time() + (30), "/");
                    header("Location: main.php");
                }
                exit;
            } else {
                // Invalid password
                // setcookie("error", "default", time() + (30 * 30), "/");
            }
        } else {
            // Handle login failure (e.g., wrong email)
            // setcookie("error", "default", time() + (86400 * 30), "/");
            // echo "No results found or query error!";
        }

        // Close the statement
        $stmt->close();
    }
    
    // Close the database connection
    $con->close();
    echo "<script type='text/javascript'>alert('Login failed!');document.location='login.html';</script>";
    // header("Location: login.html");
    // exit;

}


?>