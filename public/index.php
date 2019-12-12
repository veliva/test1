<?php
require_once("../protected/bootstrap.php");

if (isset($_GET['action'])) {
    $requested_page = $_GET['action'];
} else {
    $requested_page = "";
}

switch($requested_page) {
    case "add":
        include("../protected/addRow.php");
        break;
    case "edit":
        include("../protected/editRow.php");
        break;
    case "update":
        include("../protected/updateRow.php");
        break;
    case "delete":
        include("../protected/deleteRow.php");
        break;
    case "reset":
        include("../protected/reset.php");
        break;
    case "upload":
        include("../protected/upload.php");
        break;
    case "CSVtoArray":
        include("../protected/CSVtoArray.php");
        break;
    case "download":
        include("../protected/download.php");
        break;
    default:
        include("../protected/main.php");
}

?>