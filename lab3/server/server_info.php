<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("Location: other_page.php");
    exit;
}

echo "IP: {$_SERVER['REMOTE_ADDR']}<br>";
echo "User Agent: {$_SERVER['HTTP_USER_AGENT']}<br>";
echo "Script: {$_SERVER['PHP_SELF']}<br>";
echo "Request Method: {$_SERVER['REQUEST_METHOD']}<br>";
echo "File Path: {$_SERVER['SCRIPT_FILENAME']}<br>";

