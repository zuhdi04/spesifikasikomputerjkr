<?php
session_start();
$link = basename($_SERVER['PHP_SELF']);

// if( isset($_SESSION['j_From']) && $link!="acc-login.php" ){
//     echo $_SESSION['j_From'];
//     // $_SESSION['j_From'] = null;
// }

if (!isset($_SESSION["j_Tab_admin"]) && $link != "acc-login.php") {
    $_SESSION["j_From_admin"] = $_SERVER['REQUEST_URI'];
    if ($_SERVER['QUERY_STRING'] != '')
        $_SESSION["j_From_admin"] .= '?' . $_SERVER['QUERY_STRING'];
    header("Location: ../../login");
    exit;
}

// Message observer
$notify_debug = isset($_SESSION["notify"]['debug']) ? $_SESSION["notify"]['debug'] : null;
$notify_text = isset($_SESSION["notify"]['text']) ? $_SESSION["notify"]['text'] : null;
$notify_alert = isset($_SESSION["notify"]['alert']) ? $_SESSION["notify"]['alert'] : null;
$notify_log = isset($_SESSION["notify"]['log']) ? "<script>console.log('" . $_SESSION['notify']['log'] . "')</script>" : null;
$_SESSION["notify"] = null;

echo $notify_debug;

//nav
$teststring = '
{
    "akaun":{
        "index":"../akaun/",
        "create":"../akaun/create",
        "edit":"../akaun/edit",
        "delete":"../akaun/delete"},
    "spesifikasi":{
        "index":"../spesifikasi/",
        "create":"../spesifikasi/create",
        "edit":"../spesifikasi/edit",
        "delete":"../spesifikasi/delete.php"},
    "account":{
        "login":"login",
        "logout":"../logout"}
}
';
$pages = json_decode($teststring);

$request_method = $_SERVER['REQUEST_METHOD'];
?>