<?php
class Save {

    function test($elements) {
        print_r($elements);
        // file_put_contents('uploads/data.csv', "");
        $file = fopen('uploads/data.csv', 'w');
        $i = 0;
        foreach ($elements as $value) {
            $text = $elements['row'.$i][0].",".$elements['row'.$i][1];

            if($value == end($elements)) {
                fwrite($file, $text);
            } else {
                fwrite($file, $text."\n");
            }
            
            $i++;
        }

        fclose($file);

        header("Location: main.php?uploadOk=true");
    }
}

$test = new Save;
$test->test($_POST);
?>