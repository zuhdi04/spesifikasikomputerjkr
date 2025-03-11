<?php
session_start();
$link = basename(parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH));
if(!isset($_SESSION["j_Tab"])&&$link!="acc-login.php"){
    header("Location: login");
    exit;
}

// Message observer
$notify_debug = isset($_SESSION["notify"]['debug']) ? $_SESSION["notify"]['debug'] : null;
$notify_text = isset($_SESSION["notify"]['text']) ? $_SESSION["notify"]['text'] : null;
$notify_alert = isset($_SESSION["notify"]['alert']) ? $_SESSION["notify"]['alert'] : null;
$notify_log = isset($_SESSION["notify"]['log']) ? "<script>console.log(" . $_SESSION['notify']['log'] . ")</script>" : null;
$_SESSION["notify"]=null;

echo $notify_debug;

//nav
$pages=json_decode('
{
    "":{
        "index":"../akaun/",
        "create":"../akaun/create.php",
        "edit":"../akaun/edit.php",
        "delete":"../akaun/delete.php"},
    "spesifikasi":{
        "index":".",
        "create":"create",
        "edit":"edit",
        "delete":"delete.php"},
    "account":{
        "login":"login",
        "logout":"logout"}
}
');

$request_method = $_SERVER['REQUEST_METHOD'];
?>