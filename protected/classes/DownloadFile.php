<?php

class DownloadFile {
    private $file;

    public function __construct($file) {
        $this->file = $file;
    }

    public function download() {
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

?>