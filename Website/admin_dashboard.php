<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - UrbanVogue Collective</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
<header>
    <a href="admin_dashboard.php" style="text-decoration: none; color: #333;">
        <h1 style="font-family: Garamond, serif; color: white;">&nbsp;&nbsp;-ADMIN- UrbanVogue Collective</h1>
    </a>
</header>

<main>
    <h2 style="text-align: center;">Welcome, Admin!</h2>

    <div class="proceed-to-payment">
    <a href="admin_viewed.php" class="admin-button">View Most Viewed Product</a>
    </div>

    <div class="proceed-to-payment">
    <a href="admin_popularity.php" class="admin-button">View Most Popular Products</a>
    </div>

    <div class="proceed-to-payment">
    <a href="admin_search.php" class="admin-button">View Most Searched Product</a>
    </div>

    <div class="proceed-to-payment">
    <a href="admin_logout.php" class="logout-btn">Sign Out</a>
    </div>

    </main>
</body>
</html>
