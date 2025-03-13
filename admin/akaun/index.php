<?php
require '../valid.php';

if($request_method === "POST"){
    
    $admin_username = $_POST['username'];
    $admin_password = $_POST['password'];
    $admin_cawangan = isset( $_POST['cawangan'] ) ? strtoupper( $_POST['cawangan'] ) : null;
    
    include '../db_connect.php';
    $stmt = $conn->prepare("SELECT username FROM admin WHERE username=?");
    $stmt->bind_param("s",$admin_username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($existing_username);
    $stmt->fetch();
    
    $stmt = $conn->prepare("SELECT nama FROM unit WHERE nama=?");
    $stmt->bind_param("s",$admin_cawangan);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($existing_cawangan);
    $stmt->fetch();
    
    if($existing_username!=null){
        $_SESSION['notify']=["text" => "Username telah digunakan!"];
    }
    else if($existing_cawangan!=null){
        $_SESSION['notify']=["text" => "Cawangan telah ada!"];

    }
    else{
        $uniqcode = uniqid();
        $stmt = $conn->prepare("SELECT unitCode FROM unit WHERE unitCode=?");
        $stmt->bind_param("s",$uniqcode);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($existing_code);
        $stmt->fetch();
    // insert
        if($existing_code==null)
        {
            $stmt = $conn->prepare("INSERT INTO unit(nama,unitCode) VALUES (?,?)");
            $stmt->bind_param("ss", $admin_cawangan, $uniqcode);

            if ($stmt->execute()) {
                $pass = password_hash($admin_password, PASSWORD_DEFAULT);
                $last_id = $conn->insert_id;
                $sql = "INSERT INTO admin(username,unitID,password,password_encrypt)
                VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $admin_username, $last_id, $admin_password, $pass);

                if ($stmt->execute()) {
                    $_SESSION["notify"] = ['text' => 'Add successful'];
                    // echo json_encode(['message' => 'Add successful']);
                } else {
                    // echo json_encode(['message' => 'Add failed: ' . $stmt->error]);
                }
            } else {
                // echo json_encode(['message' => 'Add failed: ' . $stmt->error]);
            }
        }
    }

    $stmt->close();
    $conn->close();
    header("Location: ".$pages->akaun->index);
    exit;
}

include '../db_connect.php';
$stmt = $conn->prepare("SELECT username, unit.nama, password, admin.unitID FROM admin INNER JOIN unit ON admin.unitID=unit.id ORDER BY unit.nama");
$stmt->execute();
$result = $stmt->get_result();
// $data = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

// $admins = json_encode($data);
function unitCount($target){
    include '../db_connect.php';
    $sql = "SELECT COUNT(unitID) FROM pc WHERE unitID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$target);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    return $count;
}

?>

<?php include('../layout/header.php'); ?>

<div class="content">
    <div class="form-container">
        <h1>SPESIFIKASI KOMPUTER KAKITANGAN JKR KEDAH</h1>
        <!-- <h2>Admin Management</h2>
        <form class="form-container" method="POST" action="addAdminList.php" id="admin-form" hidden>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter Username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>

            <label for="cawangan">Cawangan</label>
            <select name="cawangan" id="unit_select">
                </!-- <option value="volvo">Volvo</option> --/>
            </select>
            </!-- <input type="text" id="cawangan" name="cawangan" placeholder="Enter Cawangan" required> --/>

            <button type="submit" name="addadmin" class="btnAdd">Add Admin</button><br>
        </form> -->

        <div class="admin-list" id="admin-list">
            <h2>Admin Accounts</h2>
            <br>
            <!-- Admin items will appear here -->
            <table id="staffTable" class="display" border="display">
                <thead>
                    <tr>
                        <th>USERNAME</th>
                        <th>PASS</th>
                        <th>CAWANGAN/ DAERAH/ UNIT/ BAHAGIAN</th>
                        <th>JUMLAH</th>
                        <th>OPERASI</th>
                    </tr>
                </thead>
                <tbody id="stafflist">
                    <?php
                    // foreach ($data as $row){
                    while($admin = $result->fetch_object()){
                        echo "<tr>
                                <td>$admin->username</td>
                                <td><input type='password' value='$admin->password' id='password-field-$admin->username' disabled='' style='width:85%'><span toggle='#password-field-$admin->username' class='fa fa-fw fa-eye-slash field-icon toggle-password' value='1'></span></div></td>
                                <td>$admin->nama</td>
                                <td>".unitCount($admin->unitID)."</td>
                                <td><a href='delete' class='delete_details' data-name='$admin->username' onclick='return false;'>Delete</a></td>
                            </tr>"; 
                    }
                    ?>
                    <!-- <tr>
                        <td>1</td>
                    </tr> -->
                </tbody>
            </table>
            <br>
            <button id="tambahunit" class="btnAdd">Tambah Admin</button>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content content">
        <span class="close">&times;</span>
        <h2>Admin Management</h2>
        <form class="form-container" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" id="admin-form">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter Username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>

            <label for="cawangan">Cawangan</label>
            <input type="text" id="cawangan" name="cawangan" placeholder="Enter Cawangan" required>

            <button type="submit" name="addadmin" class="btnAdd">Add Admin</button><br>
        </form>
    </div>

</div>

<script>
    $("#stafflist").on('click','.toggle-password',function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    });
    function loadModal(){
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("tambahunit");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
    loadModal();
</script>

<?php include('../layout/footer.php'); ?>