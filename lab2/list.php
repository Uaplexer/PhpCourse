<?php
$uploadDir = 'uploads/';

if (is_dir($uploadDir)) {
    $files = array_diff(scandir($uploadDir), ['.', '..']);
    if (count($files) > 0) {
        echo "<h2>List of uploaded files:</h2>";
        echo "<ul>";
        foreach ($files as $file) {
            echo "<li><a href='$uploadDir$file'>$file</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No downloaded files";
    }
} else {
    echo "Dir not found";
}

