<?php
session_start();
class Add{
    public $key;
    public $value;
    public $array;

    function __construct($key, $value, $array) {
        $this->key = $key;
        $this->value = $value;
        $this->array = $array;
    }

    function addRow() {
        $temp = array();

        $temp[] = $this->key;
        $temp[] = $this->value;

        array_push($this->array, $temp);

        return $this->array;
    }

}

$test = new Add($_POST['keyAdd'], $_POST['valueAdd'], $_SESSION['data']);
$_SESSION['data'] = $test->addRow();

header("Location: main.php");
?>