<?php
    $current = explode("/",$_SERVER['REQUEST_URI']);
    if($current[count($current)-1]!=""):?>
    <a href="." class="btnBack">Back</a>
<?php endif;
?>