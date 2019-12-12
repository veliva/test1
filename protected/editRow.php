<?php

function dataToTable($dbconn){
    $result = $dbconn->runQuery('SELECT "id", "key", "value" FROM "keyValueTable" WHERE id=?;', array($_GET['rowNumber']));
    
    $i=0;
    foreach($result as $row) {
        if($i==0){
            echo "<form action='?action=update&id=".$row['id']."' method='post' style='width: 150px; height: 30px;' autocomplete='off'>";
            echo "<input type='submit' value='Save' style='width: 150px; height: 30px;'>";
            echo "<br><br>";
            echo "<table style='border: 1px solid black;'>\n\n";
        }
        echo "<tr>";
        echo "<td style='border: 1px solid black; text-align: center; padding: 5px;'>". "<input type='text' value='". $row['key'] ."' name='key'/> </td>";
        echo "<td style='border: 1px solid black; text-align: center; padding: 5px;'>". "<input type='text' value='". $row['value'] ."' name='value'/> </td>";
        echo "</tr>\n";
        $i++;
    }
    echo "</form>";
    echo "\n</table>";
    
    $dbconn->closeConnection();
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
    <form action="/" method="post">
        <input type="submit" value="<- Back without saving" style="width: 150px; height: 30px;">
    </form>
    <div id="tableFromCSV">
        <?php
            echo dataToTable($dbconn);
        ?>
    </div>
</body>

</html>