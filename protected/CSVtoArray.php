<?php
require_once("classes/Export.php");

$tempArray = array();
$userFileToArray = new CSVtoArray($tempArray, "../uploads/updata.csv");
$tempArray = $userFileToArray->export();

$dbconn->runQuery('TRUNCATE "keyValueTable" RESTART IDENTITY;');

foreach($tempArray as $row){
    $dbconn->runQuery('INSERT INTO "keyValueTable"(key, value) VALUES (?, ?);', array($row[0], $row[1]));
}
header("Location: /");
?>