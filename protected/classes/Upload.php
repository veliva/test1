<?php

class Upload {
    private $target_file;
    private $requiredFileType;
    private $fileFromUpload;

    public function __construct($target_file, $requiredFileType, $fileFromUpload) {
        $this->target_file = $target_file;
        $this->requiredFileType = $requiredFileType;
        $this->fileFromUpload = $fileFromUpload;
    }

    public function checkFileType() {
        $fileType = strtolower(pathinfo($this->target_file,PATHINFO_EXTENSION));
        if($fileType == $this->requiredFileType){
            return true;
        } else {
            return false;
        }
    }

    public function checkFileSize() {
        if ($this->fileFromUpload["size"] > 500000) {
            return false;
        } else {
            return true;
        }
    }

    public function upload() {
        if (move_uploaded_file($this->fileFromUpload["tmp_name"], $this->target_file)) {
            echo "The file ". basename( $this->fileFromUpload["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>
