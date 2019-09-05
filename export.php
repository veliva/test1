<?php

class Export {
    public $array;
    public $fileName;

    function __construct($array, $fileName) {
        $this->array = $array;
        $this->fileName = $fileName;
    }
}

class ArrayToCSV extends Export{
    
    function export() {
        $file = fopen($this->fileName, 'w');
        foreach($this->array as $item) {
            $text = $item[0].",".$item[1]."\n";
            fwrite($file, $text);
        }

        fclose($file);
    }
}

class ArrayToPHP extends Export {

    function export() {
        $file = fopen( $this->fileName, 'w');
        fwrite($file, "<?php"."\n");
        fwrite($file, "return ["."\n");
        
        foreach($this->array as $item) {
            $text = "'".$item[0]."'"."=>"."'".$item[1]."'".",\n";
            fwrite($file, $text);
        }

        fwrite($file, "];"."\n");
        fwrite($file, "?>"."\n");

        fclose($file);
    }
}

class CSVtoArray extends Export {

    function export() {
        $file = fopen($this->fileName, 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            array_push($this->array, array($line[0], $line[1]));
        }
        fclose($file);

        return $this->array;
    }
}

?>