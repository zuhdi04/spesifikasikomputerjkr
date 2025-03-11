<?php
session_start();
$link = basename(parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH));
if(!isset($_SESSION["j_Tab_admin"])&&$link!="acc-login.php"){
    header("Location: ../../login");
    exit;
}

// Message observer
$notify_debug = isset($_SESSION["notify"]['debug']) ? $_SESSION["notify"]['debug'] : null;
$notify_text = isset($_SESSION["notify"]['text']) ? $_SESSION["notify"]['text'] : null;
$notify_alert = isset($_SESSION["notify"]['alert']) ? $_SESSION["notify"]['alert'] : null;
$notify_log = isset($_SESSION["notify"]['log']) ? "<script>console.log('" . $_SESSION['notify']['log'] . "')</script>" : null;
$_SESSION["notify"]=null;

echo $notify_debug;

//nav
$teststring='
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
        "logout":"logout"}
}
';
$pages=json_decode($teststring);

$request_method = $_SERVER['REQUEST_METHOD'];
?>