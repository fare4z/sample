<?php

$dir = "uploads/";
$dir_subfolder = $dir . "/" . $username . "/";

if (!file_exists($dir)) {mkdir($dir, 0777);} // kalau takde folder upload

//if(!file_exists($dir_subfolder)){mkdir($dir_subfolder,0777);} // kalau takde sub folder dalam folder upload.

if (!file_exists($direktori)) {mkdir($direktori, 0777);} // or even 01777 so you get the sticky bit set

/* TUTUP CREATE FOLDER*/

# upload gambar
$fileName = $_FILES['photo']['name'];
$tmpName = $_FILES['photo']['tmp_name'];
$fileSize = $_FILES['photo']['size'];
$fileType = $_FILES['photo']['type'];

// senarai jenis fail yang dibenarkan.
$allowedExtensions = array("jpg", "gif", "png", "jpeg");

if (!empty($fileName)) {
    # HANYA MEMBENARKAN JENIS FILE DI ATAS DAN SAIZ KURANG DARI 1MB
    if (in_array(end(explode(".", strtolower($fileName))), $allowedExtensions) && $fileSize <= 900000000) {
        // get the file extension first
        $ext = substr(strrchr($fileName, "."), 1);
        $ext = strtolower($ext);
        // and now we have the spesifik file name for the upload file
        $filePath = $dir_subfolder . "PHOTO" . "." . $ext;

        // Open a known directory, and proceed to read its contents
        if (is_dir($dir_subfolder)) {
            if ($dh = opendir($dir_subfolder)) {
                while (($file = readdir($dh)) !== false) {

                    if ($file == "PHOTO.jpg" || $file == "PHOTO.gif" || $file == "PHOTO.png" || $file == "PHOTO.pdf" || $file == "PHOTO.jpeg") {
                        unlink($dir_subfolder . $file);
                    }
                }
                closedir($dh);
            }
        }
        // move file from temperory foler to destinated folder
        $result = move_uploaded_file($tmpName, $filePath);
        if (!$result) {
            echo "Error uploading Photo";
            exit;
        } else {
            echo "Upload Success";
            // SQL update path

        }
    } else {
        echo "<script>alert('Invalid Photo Type or Size!');</script>";
        exit();
    }
}
