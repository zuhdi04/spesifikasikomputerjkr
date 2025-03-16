<?php
function navlink($link)
{
    echo 'href="' . $link . '"';
    $current = explode("/", $_SERVER['REQUEST_URI']);
    $target = explode("/", $link);
    if ($current[count($current) - 2] === $target[count($target) - 2])
        echo ' class="active"';
}
?>