<?php
$prev_cart_cookie_name = 'previous_cart';
$cart_session_name = 'cart';
$cart_item_post_name = 'item';

session_start();

if (!isset($_SESSION[$cart_session_name])) {
    $_SESSION[$cart_session_name] = [];
}

if (isset($_POST[$cart_item_post_name])) {
    $_SESSION[$cart_session_name][] = $_POST[$cart_item_post_name];

    $previous_cart = isset($_COOKIE[$prev_cart_cookie_name]) ? unserialize($_COOKIE[$prev_cart_cookie_name]) : [];
    $previous_cart[] = $_POST[$cart_item_post_name];
    setcookie($prev_cart_cookie_name, serialize($previous_cart), time() + (7 * 24 * 60 * 60));
}

$cart = $_SESSION[$cart_session_name];
$previous_cart = isset($_COOKIE[$prev_cart_cookie_name]) ? unserialize($_COOKIE[$prev_cart_cookie_name]) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
</head>
<body>
<h1>Shopping Cart</h1>
<form method="POST">
    <input type="text" name="item" placeholder="Item" required>
    <button type="submit">Add to Cart</button>
</form>

<h2>Current Purchases:</h2>
<ul>
    <?php foreach ($cart as $item): ?>
        <li><?= htmlspecialchars($item) ?></li>
    <?php endforeach; ?>
</ul>

<h2>Previous Purchases (saved in cookies):</h2>
<ul>
    <?php foreach ($previous_cart as $item): ?>
        <li><?= htmlspecialchars($item) ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>
