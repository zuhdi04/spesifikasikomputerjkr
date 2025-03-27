<?php
if (isset($_POST["signin"])) {
    $username = $_POST['uname'];
    $key = $_POST['psw'];
    $remember_user = isset($_POST['remember']) ? $_POST['remember'] : null;

    require 'valid.php';

    include 'db_connect.php';
    $sql = "SELECT username,password_encrypt,admin.unitID,code FROM admin LEFT JOIN unit ON admin.unitID=unit.unitID WHERE username = ?";
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
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
                if ($remember_user != null)
                    ;
                // setcookie("user", $row['username'], time() + (86400 * 30 * 30), "/");

                // Redirect to the homepage after login
                $stmt->close();
                $conn->close();
                if ($row['unitID'] === 0) {
                    $_SESSION['j_Tab_admin'] = $row['unitID'];
                    if (isset($_SESSION['j_From_admin'])) {
                        $j_From = $_SESSION['j_From_admin'];
                        $_SESSION['j_From_admin'] = null;
                        header("Location: " . $j_From);
                    } else
                        header("Location: admin/akaun/");
                } else {
                    $_SESSION['j_Tab'] = $row['code'];

                    if (isset($_SESSION['j_From'])) {
                        $j_From = $_SESSION['j_From'];
                        $_SESSION['j_From'] = null;
                        header("Location: " . $j_From);
                    } else
                        header("Location: " . $pages->spesifikasi->index);
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
    $conn->close();
    echo "<script type='text/javascript'>alert('Login failed!');document.location='login.html';</script>";
    header("Location: login.html");
    exit;

} else {
    header("Location: login");
    exit;
}

?>