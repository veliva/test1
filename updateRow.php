<?php
include 'DBConnection.php';

$dbconn->runQuery('UPDATE "keyValueTable" SET key = ?, value=? WHERE "id" = ?;', array($_POST['key'], $_POST['value'], $_GET['id']));

$dbconn->closeConnection();

header("Location: main.php");

?>