<?php
require_once("classes/Upload.php");

$test = new Upload("../uploads/updata.csv", 'csv', $_FILES["fileToUpload"]);
$isFileTypeOk = $test->checkFileType();
$isFileSizeOk = $test->checkFileSize();
if($isFileSizeOk == true && $isFileTypeOk == true){
    $test->upload();

    header("Location: /?action=CSVtoArray");
} else {
    header("Location: /");
}

?>
