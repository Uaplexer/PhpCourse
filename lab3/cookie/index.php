<?php
$header_info = 'Location: index.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        setcookie('username', $_POST['name'], time() + (7 * 24 * 60 * 60));
        header($header_info);
    } elseif (isset($_POST['delete_cookie'])) {
        setcookie('username', '', time() - 3600);
        header($header_info);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookie Example</title>
</head>
<body>
<h1><?php echo isset($_COOKIE['username']) ? "Hello, {$_COOKIE['username']}!" : "Please enter your name:"; ?></h1>

<?php if (!isset($_COOKIE['username'])): ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Your name" required>
        <button type="submit">Save Name</button>
    </form>
<?php else: ?>
    <form method="POST">
        <button type="submit" name="delete_cookie">Delete Cookie</button>
    </form>
<?php endif; ?>
</body>
</html>
