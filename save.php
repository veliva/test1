<?php
session_start();

class Save {

    function saveData($elementsToSave) {

        $array = array();
        
        foreach($elementsToSave as $value){
            $tempArray = array();

            $tempArray[] = $value[0];
            $tempArray[] = $value[1];

            array_push($array, $tempArray);
        }

        return $array;
    }
}

$test = new Save;
$_SESSION['data'] = $test->saveData($_POST);

header("Location: main.php");
?>