<?php
session_start();
require 'Database/databaseweb.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: register_login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch();

$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ?");
$stmt->execute([$user['id']]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanVogue Collective</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>

<header>
<a href="index.php" style="text-decoration: none; color: #333;">
        <h1 style="font-family: Garamond, serif; color: white;">&nbsp;&nbsp;UrbanVogue Collective</h1>
    </a>
    <nav>
        <ul>
            <li><a href="MainPage.php">&nbsp;&nbsp;&nbsp;&nbsp;Home</a></li>
            <li><a href="index.php">Product&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <li>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<a href="profile.php">' . $_SESSION['username'] . '</a>';
            } else {
                echo '<a href="register_login.php">Account</a>';
            }
            ?>
            <li>
            <li><a href="previous.php">&nbsp;&nbsp;&nbsp;&nbsp;Previous</a></li>
            <li>
            <a href=" " class="cart-icon">&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <a href="cart.php">
                <img src="images/shopping-cart.jpg" width="30" height="30"/>
            <a href="cart.php" class="cart-icon">&nbsp;&nbsp;&nbsp;&nbsp;</a></li>

        </li>
        </ul>
    </nav>
</header>

<main>
    <h2>&nbsp;&nbsp;Your Profile</h2>

    <section class="user-details">
        <h3>&nbsp;&nbsp;Username</h3>
        <p>&nbsp;&nbsp;<?= $user['username'] ?></p>
    </section>

    <section class="user-details">
        <h3>&nbsp;&nbsp;Address</h3>
        <p>&nbsp;&nbsp;<?= $user['address'] ?></p>
    </section>

    <div class="proceed-to-payment">
    <a href="logout.php" class="logout-btn">Sign Out</a>
    </div>

    <section class="previous-orders">
    <h3>Previous Orders</h3>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['order_date'] ?></td>
                    <td><a href="reorder.php?order_id=<?= $order['id'] ?>">Re-order</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

</main>

<footer>
    This business is fictitious and part of a university course.
</footer>

<script src="Javascript/scripts.js"></script>

</body>
</html>
