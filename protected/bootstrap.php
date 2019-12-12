<?php
require_once("../config/DBconfig.php");
require_once("classes/DBConnection.php");

$dbconn = new Database($serverDBName, $serverHost, $serverUser, $serverPassword);
?>