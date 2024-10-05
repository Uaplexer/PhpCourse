<?php
$dsn = "pgsql:host=localhost;port=5432;dbname=php_course;user=postgres;password=postgres";
try {
    $pdo = new PDO($dsn);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    if ($pdo
        ->prepare("SELECT EXISTS(SELECT 1 FROM users WHERE email = :email)")
        ->execute(['email' => $email]))
    {
        echo "User with that email already exists";
        exit();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($pdo
        ->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)")
        ->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password])) {
        echo "Registration successful!";
    } else {
        echo "Error: could not register user.";
    }
}

