<?php

class Upload {
    public $target_file;
    public $requiredFileType;
    public $fileFromUpload;

    function __construct($target_file, $requiredFileType, $fileFromUpload) {
        $this->target_file = $target_file;
        $this->requiredFileType = $requiredFileType;
        $this->fileFromUpload = $fileFromUpload;
    }

    function checkFileType() {
        $fileType = strtolower(pathinfo($this->target_file,PATHINFO_EXTENSION));
        if($fileType == $this->requiredFileType){
            return true;
        } else {
            return false;
        }
    }

    function checkFileSize() {
        if ($this->fileFromUpload["size"] > 500000) {
            return false;
        } else {
            return true;
        }
    }

    function upload() {
        if (move_uploaded_file($this->fileFromUpload["tmp_name"], $this->target_file)) {
            echo "The file ". basename( $this->fileFromUpload["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$test = new Upload("uploads/updata.csv", 'csv', $_FILES["fileToUpload"]);
$isFileTypeOk = $test->checkFileType();
$isFileSizeOk = $test->checkFileSize();
if($isFileSizeOk == true && $isFileTypeOk == true){
    $test->upload();

    header("Location: main.php?upload=true");
} else {
    header("Location: main.php?upload=false");
}

?>
