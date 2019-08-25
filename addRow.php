<?php
class Add {
    public $key;
    public $value;

    function __construct($key, $value) {
        $this->key = $key;
        $this->value = $value;
    }

    function addRow() {
        if(filter_var($_POST['uploadOkHidden'], FILTER_VALIDATE_BOOLEAN) == false) {
            file_put_contents('uploads/data.csv', "");
        }

        $file = fopen( 'uploads/data.csv', 'a+');
        $text = $this->key.",".$this->value."\n";
        fwrite($file, $text);
        fclose($file);

        header("Location: main.php?uploadOk=true");
    }
}

$test = new Add($_POST['keyAdd'], $_POST['valueAdd']);
$test->addRow();
?>