<?php
session_start();
class Delete {
    public $rowNumber;
    public $array;

    function __construct($rowNumber, $array) {
        $this->rowNumber = $rowNumber;
        $this->array = $array;
    }

    function deleteRow(){
        unset($this->array[$this->rowNumber]);
        $this->array = array_values($this->array);
        print_r($this->array);

        return $this->array;
    }
        
}

if(isset($_GET['rowNumber'])){
    $test = new Delete($_GET['rowNumber'], $_SESSION['data']);
    $_SESSION['data'] = $test->deleteRow();

    header("Location: main.php");
}

?>