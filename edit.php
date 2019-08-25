<?php
function CSVtoTable(){
    echo "<form action='save.php' method='post' style='width: 150px; height: 30px;' autocomplete='off'>";
    echo "<input type='submit' value='Save' style='width: 150px; height: 30px;'>";
    echo "<br><br>";
    echo "<table style='border: 1px solid black;'>\n\n";
    $f = fopen("uploads/data.csv", "r");
    $i = 0;
    while (($line = fgetcsv($f)) !== false) {
        echo "<tr>";
        foreach ($line as $cell) {
            echo "<td style='border: 1px solid black; text-align: center; padding: 5px;'>". "<input type='text' value='". htmlspecialchars($cell) ."' name='row". $i ."[]" ."'/> </td>";
        }
        $i++;
        echo "</tr>\n";
    }
    fclose($f);
    echo "</form>";
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
    <form action="main.php?uploadOk=true" method="post">
        <input type="submit" value="<- Back without saving" style="width: 150px; height: 30px;">
    </form>
    <div id="tableFromCSV"><?php echo CSVtoTable(); ?></div>
</body>

</html>