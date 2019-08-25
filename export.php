<?php
class Export {
    public $file;

    function __construct($file) {
        $this->file = $file;
    }

    function exportFile() {
        if (file_exists($this->file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($this->file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($this->file));
            readfile($this->file);
            exit;
        }
    }
}

class ExportToPHP extends Export {
    public $elements = array();

    function __construct(){
        parent::__construct("data.php");
    }

    function CSVtoArray() {
        $file = fopen('uploads/data.csv', 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            // print_r($line);
            array_push($this->elements, array($line[0], $line[1]));
        }
        fclose($file);
        // echo "<br>";
    }

    function arrayToPHP() {
        // print_r($this->elements);
        $file = fopen( 'data.php', 'w');
        fwrite($file, "<?php"."\n");
        fwrite($file, "return ["."\n");
        
        $i = 0;
        foreach($this->elements as $item) {
            fwrite($file, "'".$item[0]."'"."=>"."'".$item[1]."'");
            
            if(count($this->elements) != $i) {
                fwrite($file, ",\n");
            } else {
                fwrite($file, "\n");
            }

            $i++;
        }

        fwrite($file, "];"."\n");
        fwrite($file, "?>"."\n");

        fclose($file);
    }
}
?>