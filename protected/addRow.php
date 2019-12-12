<?php

$dbconn->runQuery('INSERT INTO "keyValueTable"(key,value) VALUES (?, ?)', array($_POST['keyAdd'], $_POST['valueAdd']));

$dbconn->closeConnection();

header("Location: /");
?>