<?php
session_start();
$dsn = "pgsql:host=localhost;port=5432;dbname=php_course;user=postgres;password=postgres";
try {
    $pdo = new PDO($dsn);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

if ($_POST['action'] == 'register') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT EXISTS(SELECT 1 FROM users WHERE email = :email)");
    $stmt->execute(['email' => $email]);
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        echo 'User with that email already exists!';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $pdo
            ->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)")
            ->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password]);
        echo 'Registration successful!';
    }
}

if ($_POST['action'] == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($password, $user['password']) && $user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo 'Login successful!';
    } else {
        echo 'Wrong email or password!';
    }
}
