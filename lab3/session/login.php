<?php
$ex_login = 'admin';
$ex_password = 'admin';

$header_info = 'Location: login.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header($header_info);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $ex_login && $password === $ex_password) {
        $_SESSION['user'] = $username;
        $_SESSION['last_activity'] = time();
        header($header_info);
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}

if (isset($_SESSION['user'])) {
    echo "Hello, {$_SESSION['user']}!";
    echo '<form method="POST"><button type="submit" name="logout">Logout</button></form>';
} else {
    ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <?php if (isset($error)) echo $error; ?>
    <?php
}
?>
