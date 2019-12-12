<?php
include "DBConnection.php";

if(isset($_GET['rowNumber'])){
    $dbconn->runQuery('DELETE FROM "keyValueTable" WHERE "id" = ?;', array($_GET['rowNumber']));

    $dbconn->closeConnection();
}

header("Location: main.php");
?>