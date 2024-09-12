<?php
if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    if (!empty($first_name) && !empty($last_name)) {
        echo "Hello, " . htmlspecialchars($first_name) . " " . htmlspecialchars($last_name) . "!";
    } else {
        echo "Please fill out all fields.";
    }
} else {
    echo "Form data not received.";
}

