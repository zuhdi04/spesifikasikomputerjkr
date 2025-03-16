<?php
session_start();
$link = basename(parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH));
if (!isset($_SESSION["j_Tab"]) && $link != "acc-login.php") {
    header("Location: login.html");
    exit;
}

if (isset($_SESSION["notification"])) {
    echo $_SESSION["notification"];
    $_SESSION["notification"] = null;
}

include 'db_connect.php';

//nav
$pages = json_decode('{
    "acc-login":{
        "title":"spesifikasi",
        "url":"acc-login.php",
        "method":"POST"},
    "main":{
        "title":"spesifikasi",
        "url":"main.php",
        "method":"GET"},
    "create":{
        "title":"spesifikasi",
        "url":"create.php",
        "method":"GET"},
    "edit":{
        "title":"spesifikasi",
        "url":"edit.php",
        "method":"GET"},
    "store":{
        "title":"spesifikasi",
        "url":"store.php",
        "method":"POST"},
    "update":{
        "title":"spesifikasi",
        "url":"update.php",
        "method":"POST"},
    "delete":{
        "title":"spesifikasi",
        "url":"delete.php",
        "method":"POST"},
    "notfound":{
        "title":"error",
        "url":"error",
        "method":"GET"}
}');

$request_method = $_SERVER['REQUEST_METHOD'];

$path = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);
$lastPathname = basename($path);
$page = chop($lastPathname, ".php");
if ($pages->{$page}->method != $request_method)
    header("Location:" . $pages->notfound->url); // handle wrong method: display error page
?>