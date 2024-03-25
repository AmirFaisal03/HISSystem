<?php
require 'Database/databaseweb.php';

if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ?");
    $stmt->execute(["%$searchQuery%"]);
    $results = $stmt->fetchAll();

    // Increment search
    foreach ($results as $product) {
        $productId = $product['id'];
        $pdo->exec("UPDATE products SET search_count = search_count + 1 WHERE id = $productId");
    }
}

// Searched Products
$stmt = $pdo->query("SELECT * FROM products ORDER BY search_count DESC LIMIT 6");
$searchedProducts = $stmt->fetchAll();
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
            <li>

            <li><a href="index.php">Product</a></li>
            <li>
            <li>
            <li><a href="previous.php">Previous</a></li>
            <li>
                <a href="cart.php">
                    <img src="images/shopping-cart.jpg" width="30" height="30"/>
                </a>
            </li>
        </ul>
    </nav>
</header>

<div style="text-align: center; margin:0;"class="banner-ad">
    <img src="images/banner6.jpg" alt="Special Offer!">
</div>

<main>
    <!-- Search -->
    <form class="search-form" action="search.php" method="get">
        <label class="search-label" for="search">Search:</label>
        <input class="search-input" type="text" id="search" name="query" placeholder=" ">
        <button class="search-button" type="submit">Search</button>
    </form>
</main>

<main>
    <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>

    <?php if (isset($results) && count($results) > 0) : ?>
        <ul class="products">
            <?php foreach ($results as $product) : ?>
                <li class="product">
                    <img src=images/<?php echo htmlspecialchars($product['image']); ?> alt="Product Image">
                    <p>Rating: <?php echo htmlspecialchars($product['rate_average']) . ' ( ' . htmlspecialchars($product['rate_count']) . ' ) '; ?></p>
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>

                    <button class="view-more" data-product-id="<?php echo $product['id']; ?>" onclick="window.location.href='product.php?id=<?php echo $product['id']; ?>'">View More</button>
                </li>
                
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>   No results found.</p>
        <button onclick="goBack()">Back</button>
        <script>
        
        function goBack() {
            window.history.back();
        }
    </script>

    <?php endif; ?>

    <!-- Searched Products -->
    <h1 style="text-align: center;">Most Searched Products</h1>
    <div class="product-container">
        <?php foreach ($searchedProducts as $product) : ?>
            <div class="product">
                <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <p>Rating: <?php echo htmlspecialchars($product['rate_average']) . ' ( ' . htmlspecialchars($product['rate_count']) . ' ) '; ?></p>
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>$<?php echo $product['price']; ?></strong></p>
                <button class="view-more" data-product-id="<?php echo $product['id']; ?>" onclick="window.location.href='product.php?id=<?php echo $product['id']; ?>'">View More</button>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<footer>
    This business is fictitious and part of a university course.
</footer>

<script src="Javascript/scripts.js"></script>

</body>
</html>
