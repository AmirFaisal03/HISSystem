<?php
session_start();

require 'Database/databaseweb.php';

// Popular Products
$stmt = $pdo->query("SELECT * FROM products ORDER BY popularity DESC LIMIT 5");
$topProducts = $stmt->fetchAll();

// Viewed Products
$stmt = $pdo->query("SELECT * FROM products ORDER BY viewed DESC LIMIT 5");
$viewedProducts = $stmt->fetchAll();

// Searched Products
$stmt = $pdo->query("SELECT * FROM products ORDER BY search_count DESC LIMIT 5");
$searchedProducts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanVogue Collective</title>
    <link rel="stylesheet" href="CSS/styles.css">

    <style>
        .product-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
            padding: 2em;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        body {
        margin: 0;
        padding: 0;
        }

        main {
        max-width: 1500px;
        margin: 20px auto;
        padding: 10px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    </style>

</head>
<body>

<header>
    <a href="index.php" style="text-decoration: none; color: #333;">
        <h1 style="font-family: Garamond, serif; color: white;">&nbsp;&nbsp;UrbanVogue Collective</h1>
    </a>
    <nav>
        <ul>
            <li><a href="MainPage.php">&nbsp;&nbsp;&nbsp;&nbsp;Home&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            
            <li><a href="index.php">&nbsp;&nbsp;&nbsp;&nbsp;Product&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <li>

                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo '<a href="profile.php">' . $_SESSION['username'] . '</a>';
                } else {
                    echo '<a href="register_login.php">Account</a>';
                }
                ?>
            </li>
            <li>
            <li><a href="previous.php">&nbsp;&nbsp;&nbsp;&nbsp;Previous</a></li>
            <li>
            <li>
                <a href="cart.php">
                    <img src="images/shopping-cart.jpg" width="30" height="30"/>
                    <span class="cart-icon">(<span id="cart-count"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>)</span>
                </a>
            </li>
        </ul>
    </nav>
</header>

<div style="text-align: center; margin:0;"class="banner-ad">
    <img src="images/banner1.jpg" alt="Special Offer!">
</div>

<h1 style="text-align: center;">Popular Products</h1>

<main>
    <!-- Popular Products -->
    <div class="product-container">
        <?php foreach ($topProducts as $product) : ?>
            <div class="product">
                <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>$<?php echo $product['price']; ?></strong></p>
                <p>Rating: <?php echo htmlspecialchars($product['rate_average']) . ' ( ' . htmlspecialchars($product['rate_count']) . ' ) '; ?></p>
            </div>
            
        <?php endforeach; ?>
        <button class="view-more" onclick="window.location.href='index.php?id=<?php echo $product['id']; ?>'">View More</button> 
    </div>

</main>

<h1 style="text-align: center;">Most Viewed Products</h1>

<main>
    <!-- Viewed Products -->
    <div class="product-container">
        <?php foreach ($viewedProducts as $product) : ?>
            <div class="product">
                <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>$<?php echo $product['price']; ?></strong></p>
                <p>Rating: <?php echo htmlspecialchars($product['rate_average']) . ' ( ' . htmlspecialchars($product['rate_count']) . ' ) '; ?></p>
            </div>
            
        <?php endforeach; ?>
        <button class="view-more" onclick="window.location.href='index.php?id=<?php echo $product['id']; ?>'">View More</button> 
    </div>
</main>

<h1 style="text-align: center;">Most Searched Products</h1>

<main>
    <!-- Searched Products -->
    <div class="product-container">
        <?php foreach ($searchedProducts as $product) : ?>
            <div class="product">
                <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>$<?php echo $product['price']; ?></strong></p>
                <p>Rating: <?php echo htmlspecialchars($product['rate_average']) . ' ( ' . htmlspecialchars($product['rate_count']) . ' ) '; ?></p>
            </div>
            
        <?php endforeach; ?>
        <button class="view-more" onclick="window.location.href='index.php?id=<?php echo $product['id']; ?>'">View More</button> 
    </div>
</main>

<a style="text-align: center; margin:1;" class="banner-ad" href="index.php">
    <img src="images/banner2.jpg" alt="Special Offer!"/>
    </a>

<div style="text-align: center; margin:1;"class="banner-ad">
    <img src="images/banner3.jpg" alt="Special Offer!">
</div>

<footer>
    This business is fictitious and part of a university course.
</footer>

<script src="Javascript/scripts.js"></script>

</body>
</html>
