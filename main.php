<?php
include 'export.php';
include 'downloadFile.php';
include 'DBConnection.php';

function exportDatabase($dbconn) {
    $result = $dbconn->runQuery('SELECT "id", "key", "value" FROM "keyValueTable" ORDER BY id ASC');
    $tempArray = array();
    foreach($result as $row) {
        array_push($tempArray, array($row['key'], $row['value']));
    }
    
    if(count($tempArray)>0){
        if(array_key_exists('CSV',$_GET) && $_GET['CSV'] == true){
            $test = new ArrayToCSV($tempArray, "download/data.csv");
            $fileToDownload = "download/data.csv";
        } elseif(array_key_exists('PHP',$_GET) && $_GET['PHP'] == true) {
            $test = new ArrayToPHP($tempArray, "download/data.php");
            $fileToDownload = "download/data.php";
        }
        $test->export();
        $download = new DownloadFile($fileToDownload);
        $download->download();
    }
}

function CSVtoDatabase($dbconn) {
    $tempArray = array();
    $userFileToArray = new CSVtoArray($tempArray, "uploads/updata.csv");
    $tempArray = $userFileToArray->export();
    
    $dbconn->runQuery('TRUNCATE "keyValueTable" RESTART IDENTITY;');

    foreach($tempArray as $row){
        $dbconn->runQuery('INSERT INTO "keyValueTable"(key, value) VALUES (?, ?);', array($row[0], $row[1]));
    }
}

if(array_key_exists('CSV',$_GET) && $_GET['CSV'] == true || array_key_exists('PHP',$_GET) && $_GET['PHP'] == true) {
    exportDatabase($dbconn);
}

if(array_key_exists('upload',$_GET) && $_GET['upload'] == true) {
    CSVtoDatabase($dbconn);
}

function dataToTable($dbconn) {
    $result = $dbconn->runQuery('SELECT "id", "key", "value" FROM "keyValueTable" ORDER BY id ASC');

    echo "<table style='border: 1px solid black;'>\n\n";
    foreach($result as $row){
        echo "<tr>";
        echo 
        "<td style='border: 1px solid black;'>
            <form action='deleteRow.php?rowNumber=". $row['id'] ."' method='post' style='vertical-align:middle;
            display: inline;' >
            <input id='deleteButton". $row['id'] ."' type='submit' value='Delete' />
            </form>
        </td>";
        echo 
        "<td style='border: 1px solid black;'>
            <form action='editRow.php?rowNumber=". $row['id'] ."' method='post' style='vertical-align:middle;
            display: inline;' >
            <input id='editButton". $row['id'] ."' type='submit' value='Edit' />
            </form>
        </td>";
        echo "<td style='border: 1px solid black;' align='center'; padding: 5px;>" . $row['key'] . "</td>";
        echo "<td style='border: 1px solid black;' align='center'; padding: 5px;>" . $row['value'] . "</td>";
        echo "</tr>";
    }
    echo "\n</table>";
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test1</title>
</head>

<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select .csv file:
    <input type="file" name="fileToUpload" id="fileToUpload" accept=".csv" required>
    <input type="submit" value="Import from CSV" name="submit">
</form>
<br><br><hr>
<form action="main.php?CSV=true" method="post" style="float: left;">
    <input type="submit" value="Export to CSV" />
</form>
<form action="main.php?PHP=true" method="post">
    <input type="submit" value="Export to PHP" />
</form>
<hr>
<h1><a href="main.php" style="color: black;text-decoration: none;">Key Value editor</a></h1>
<br>
<form action="addRow.php" method="post" autocomplete="off">
    <span>Add row to the table: </span>
    <input type="text" id="keyAdd" name="keyAdd" placeholder="Key" required>
    <input type="text" id="valueAdd" name="valueAdd" placeholder="Value" required>
    <input type="submit" value="Add">
</form>
<form action="reset.php">
    <input type="submit" value="Reset table">
</form>
<br>
<div id="tableFromData">
    <?php
        echo dataToTable($dbconn);
    ?>
</div>
    
</body>

</html>