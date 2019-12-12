<?php
include "DBConnection.php";

$dbconn->runQuery('TRUNCATE "keyValueTable" RESTART IDENTITY;');

$dbconn->closeConnection();

header("Location: main.php");
?>