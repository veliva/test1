<?php

function dataToTable($dbconn) {
    $result = $dbconn->runQuery('SELECT "id", "key", "value" FROM "keyValueTable" ORDER BY id ASC');

    echo "<table style='border: 1px solid black;'>\n\n";
    foreach($result as $row){
        echo "<tr>";
        echo 
        "<td style='border: 1px solid black;'>
            <form action='?action=delete&id=". $row['id'] ."' method='post' style='vertical-align:middle;
            display: inline;' >
            <input id='deleteButton". $row['id'] ."' type='submit' value='Delete' />
            </form>
        </td>";
        echo 
        "<td style='border: 1px solid black;'>
            <form action='?action=edit&rowNumber=". $row['id'] ."' method='post' style='vertical-align:middle;
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

<form action="?action=upload" method="post" enctype="multipart/form-data">
    Select .csv file:
    <input type="file" name="fileToUpload" id="fileToUpload" accept=".csv" required>
    <input type="submit" value="Import from CSV" name="submit">
</form>
<br><br><hr>
<form action="?action=download&type=CSV" method="post" style="float: left;">
    <input type="submit" value="Export to CSV" />
</form>
<form action="?action=download&type=PHP" method="post">
    <input type="submit" value="Export to PHP" />
</form>
<hr>
<h1><a href="/" style="color: black;text-decoration: none;">Key Value editor</a></h1>
<br>
<form action="?action=add" method="post" autocomplete="off">
    <span>Add row to the table: </span>
    <input type="text" id="keyAdd" name="keyAdd" placeholder="Key" required>
    <input type="text" id="valueAdd" name="valueAdd" placeholder="Value" required>
    <input type="submit" value="Add">
</form>
<form action="?action=reset" method="post">
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