<?php
$target_dir = "uploads/";
$target_file = $target_dir . "data.csv";
echo $target_file;
$uploadOk = true;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

function moveToMain($isUploadOk){
    header("Location: main.php?uploadOk=".$isUploadOk);
}

if(isset($_POST["submit"])) {
    if($fileType == 'csv'){
        echo "It really is csv file!";
        $uploadOk = true;
    } else {
        echo "Only csv files are allowed!";
        $uploadOk = false;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = false;
    }

    if ($uploadOk == false) {
        echo "Sorry, your file was not uploaded.";
        moveToMain($uploadOk);
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            moveToMain($uploadOk);
        } else {
            echo "Sorry, there was an error uploading your file.";
            moveToMain($uploadOk);
        }
    }
}
?>
