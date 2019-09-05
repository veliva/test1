<?php

session_start();

include 'export.php';
include 'downloadFile.php';

if(!isset($_SESSION['data'])){
    $_SESSION['data'] = array();
}

if(array_key_exists('CSV',$_GET) && $_GET['CSV'] == true && count($_SESSION['data'])>0) {
    $test = new ArrayToCSV($_SESSION['data'], "download/data.csv");
    $test->export();

    $download = new DownloadFile("download/data.csv");
    $download->download();
}

if(array_key_exists('PHP',$_GET) && $_GET['PHP'] == true && count($_SESSION['data'])>0) {
    $test = new ArrayToPHP($_SESSION['data'], "download/data.php");
    $test->export();

    $download = new DownloadFile("download/data.php");
    $download->download();
}

if(array_key_exists('upload',$_GET) && $_GET['upload'] == true) {
    $tempArray = array();
    $test = new CSVtoArray($tempArray, "uploads/updata.csv");
    $tempArray = $test->export();
    $_SESSION['data'] = array();
    $_SESSION['data'] = $tempArray;
}

function dataToTable() {
    echo "<form action='edit.php' method='post' style='vertical-align:middle;
    display: inline;' >
    <input id='editButton' type='submit' value='Edit' style='width: 100px; height: 30px;'/>
    </form>";
    echo "<br><br>";
    echo "<table style='border: 1px solid black;'>\n\n";
    $i = 0;
    foreach ($_SESSION['data'] as $value) {
        echo "<tr>";
        echo 
        "<td style='border: 1px solid black;'>
            <form action='deleteRow.php?rowNumber=".$i."' method='post' style='vertical-align:middle;
            display: inline;' >
            <input id='deleteButton".$i."' type='submit' value='Delete' />
            </form>
        </td>";
        foreach ($value as $cell) {
            echo "<td style='border: 1px solid black; text-align: center; padding: 5px;'>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n";
        $i++;
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
<form action="destroy.php">
    <input type="submit" value="Reset table">
</form>
<br>
<div id="tableFromData"><?php if(!empty($_SESSION['data'])) { echo dataToTable(); } ?></div>
    
</body>

</html>