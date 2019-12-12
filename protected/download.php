<?php
require_once("classes/DownloadFile.php");
require_once("classes/Export.php");

if (isset($_GET['type'])) {
    $fileType = $_GET['type'];
} else {
    $fileType = "";
}

$result = $dbconn->runQuery('SELECT "id", "key", "value" FROM "keyValueTable" ORDER BY id ASC');
$tempArray = array();
foreach($result as $row) {
    array_push($tempArray, array($row['key'], $row['value']));
}

if(count($tempArray)>0){
    if($fileType == "CSV"){
        $test = new ArrayToCSV($tempArray, "../download/data.csv");
        $fileToDownload = "../download/data.csv";
    } elseif($fileType == "PHP") {
        $test = new ArrayToPHP($tempArray, "../download/data.php");
        $fileToDownload = "../download/data.php";
    }
    $test->export();
    $download = new DownloadFile($fileToDownload);
    $download->download();
}

header("Location: /");

?>