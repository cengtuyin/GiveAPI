<?php
$ui = $_REQUEST["ui"];
switch ($ui) {
    case 'login':
        include_once("./Web/login.php");
        break;
    default:
        # code...
        break;
}
?>