<?php
$uploadDir = 'uploads/';
$allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];
$maxFileSize = 2 * 1024 * 1024; // 2 MB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
        $file = $_FILES['file'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $fileName = basename($file['name']);
        $filePath = $uploadDir . $fileName;

        if (!in_array($fileType, $allowedTypes)) {
            echo "Only types PNG, JPG or JPEG are allowed";
        } elseif ($fileSize > $maxFileSize) {
            echo "File exceeds the size limit of 2 MB";
        } else {
            if (file_exists($filePath)) {
                $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
                $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                $fileName = $fileNameWithoutExt . '_' . time() . '.' . $fileExt;
                $filePath = $uploadDir . $fileName;
            }

            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                echo "File successfully uploaded: <br>";
                echo "Filename: $fileName <br>";
                echo "File type: $fileType <br>";
                echo "File size: " . round($fileSize / 1024, 2) . " KB <br>";
                echo "<a href='$filePath'>Show file</a>";
            } else {
                echo "Error when saving the file";
            }
        }
    } else {
        echo "File not uploaded";
    }
}

