<?php
session_start();

$dsn = "pgsql:host=localhost;port=5432;dbname=php_course;user=postgres;password=postgres";
try {
    $pdo = new PDO($dsn);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Перевірка пароля
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header('Location: index.php');
        exit();
    } else {
        echo "Invalid username or password.";
    }
}

