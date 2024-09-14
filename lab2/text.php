<?php
$logFile = 'log.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['text'])) {
        $text = htmlspecialchars($_POST['text']);
        file_put_contents($logFile, $text . PHP_EOL, FILE_APPEND);
        echo "Text successfully written into log.txt<br>";
    } else {
        echo "Text cannot be empty";
    }
}

if (file_exists($logFile)) {
    echo "<h2>log.txt:</h2>";
    $content = file_get_contents($logFile);
    echo nl2br($content);
}

