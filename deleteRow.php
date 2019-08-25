<?php
class Delete {
    public $rowNumber;

    function __construct($rowNumber) {
        $this->rowNumber = $rowNumber;
    }

    function deleteRow(){
        echo $this->rowNumber;

        $in = fopen( 'uploads/data.csv', 'r');
        $out = fopen( 'temp.csv', 'w');
        file_put_contents('temp.csv', "");

        $i = 0;
        while(($row = fgetcsv($in)) !== false) {
            print_r($row);
            if( $i == $this->rowNumber) {
                $i++;
            } else {
                fputcsv($out, $row);
                $i++;
            }
        }

        fclose($in);
        fclose($out);

        echo copy('temp.csv', 'uploads/data.csv');

        $fileLength = count(file('uploads/data.csv'));
        $uploadOk;

        if($fileLength == 0) {
            $uploadOk = false;
        } else {
            $uploadOk = true;
        }

        header("Location: main.php?uploadOk=".$uploadOk);
    }
}

if(isset($_GET['rowNumber'])){
    $test = new Delete($_GET['rowNumber']);
    $test->deleteRow();
}
?>