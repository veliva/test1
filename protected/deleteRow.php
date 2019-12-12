<?php

if(isset($_GET['id'])){
    $dbconn->runQuery('DELETE FROM "keyValueTable" WHERE "id" = ?;', array($_GET['id']));

    $dbconn->closeConnection();
}

header("Location: /");
?>