<?php
include 'export.php';

// if(isset($_GET['uploadOk'])){
//     if($_GET['uploadOk'] == false){
//         echo "File was not uploaded!";
//     } else {
//         echo "File uploaded!";
//     }
// }

function CSVtoTable(){
    echo "<form action='edit.php' method='post' style='vertical-align:middle;
    display: inline;' >
    <input id='editButton' type='submit' value='Edit' style='width: 100px; height: 30px;'/>
    </form>";
    echo "<br><br>";
    echo "<table style='border: 1px solid black;'>\n\n";
    $f = fopen("uploads/data.csv", "r");
    $i = 0;
    while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        echo 
        "<td style='border: 1px solid black;'>
            <form action='deleteRow.php?rowNumber=".$i."' method='post' style='vertical-align:middle;
            display: inline;' >
            <input id='deleteButton".$i."' type='submit' value='Delete' />
            </form>
        </td>";
        foreach ($line as $cell) {
            echo "<td style='border: 1px solid black; text-align: center; padding: 5px;'>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>\n";
        $i++;
    }
    fclose($f);
    echo "\n</table>";
}

if(array_key_exists('exportCSV',$_GET) && $_GET['exportCSV'] == true) {
    $test = new Export('uploads/data.csv');
    $test->exportFile();
}

if(array_key_exists('exportPHP',$_GET) && $_GET['exportPHP'] == true) {
    $test = new ExportToPHP();
    $test->CSVtoArray();
    $test->arrayToPHP();
    $test->exportFile();
}

function getUploadOkHiddenValue() {
    if((array_key_exists('uploadOk',$_GET)) && $_GET['uploadOk'] == true) {
        echo "true";
    } else {
        echo "false";
    }
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
    <form action="main.php?exportCSV=true" method="post" style="float: left;">
        <input type="submit" value="Export to CSV" />
    </form>
    <form action="main.php?exportPHP=true" method="post">
        <input type="submit" value="Export to PHP" />
    </form>
    <hr>
    <h1><a href="main.php" style="color: black;text-decoration: none;">Key Value editor</a></h1>
    <br>
    <form action="addRow.php" method="post" autocomplete="off">
        <input type="hidden" name="uploadOkHidden" value="<?php echo getUploadOkHiddenValue();?>">
        <span>Add row to the table: </span>
        <input type="text" id="keyAdd" name="keyAdd" placeholder="Key" required>
        <input type="text" id="valueAdd" name="valueAdd" placeholder="Value" required>
        <input type="submit" value="Add">
    </form>
    <br><br>
    <div id="tableFromCSV"><?php if((array_key_exists('uploadOk',$_GET)) && $_GET['uploadOk'] == true){echo CSVtoTable();} ?></div>
</body>

</html>