<?php
function dataToTable($serverHost, $serverDBName, $serverUser, $serverPassword){
    $db_connection = pg_connect("host=".$serverHost." dbname=".$serverDBName." user=".$serverUser." password=".$serverPassword);
    $result = pg_prepare($db_connection, "getEditableRow", 'SELECT * FROM "'.$_COOKIE['user'].'" WHERE "id" = ($1);');
    $result = pg_execute($db_connection, "getEditableRow", array($_GET['rowNumber']));
    
    $i=0;
    while($row=pg_fetch_assoc($result)){
        if($i==0){
            echo "<form action='updateRow.php?id=".$row['id']."' method='post' style='width: 150px; height: 30px;' autocomplete='off'>";
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
    pg_close($db_connection);
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
    <form action="main.php?uploadOk=true" method="post">
        <input type="submit" value="<- Back without saving" style="width: 150px; height: 30px;">
    </form>
    <div id="tableFromCSV"><?php include "../config.php";echo dataToTable($serverHost, $serverDBName, $serverUser, $serverPassword); ?></div>
</body>

</html>