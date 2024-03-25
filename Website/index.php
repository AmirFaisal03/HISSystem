<?php
session_start();

require 'Database/databaseweb.php';

// Popularity Increament
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    echo "Product ID: $productId";
    $stmt = $pdo->prepare("UPDATE products SET popularity = popularity + 1 WHERE id = ?");
    $stmt->execute([$productId]);
    echo "Popularity Updated!";
}

// View Increament
if (isset($_POST['view_more'])) {
    $productId = $_POST['product_id'];
    echo "Product ID: $productId";
    $stmt = $pdo->prepare("UPDATE products SET viewed = viewed + 1 WHERE id = ?");
    $stmt->execute([$productId]);
    echo "View Updated!";
}

// Category Seperate
$stmt = $pdo->query("SELECT * FROM products ORDER BY category");
$productsByCategory = [];
while ($row = $stmt->fetch()) {
    $productsByCategory[$row['category']][] = $row;
}

$stmt = $pdo->query("SELECT DISTINCT category FROM products");
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Popular Products
$stmt = $pdo->query("SELECT * FROM products ORDER BY popularity DESC LIMIT 6");
$topProducts = $stmt->fetchAll();

// Viewed Products
$stmt = $pdo->query("SELECT * FROM products ORDER BY viewed DESC LIMIT 6");
$viewedProducts = $stmt->fetchAll();

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
    <!-- Header -->
    <a href="index.php" style="text-decoration: none; color: #333;">
        <h1 style="font-family: Garamond, serif; color: white;">&nbsp;&nbsp;UrbanVogue Collective</h1>
    </a>
    <nav>
        <ul>
        
        <li><a href="MainPage.php">&nbsp;&nbsp;&nbsp;&nbsp;Home</a></li>
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
            <li><a href="previous.php">Previous</a></li>
            <li>
            <li>
                <a href="cart.php">
                    <img src="images/shopping-cart.jpg" width="30" height="30"/>
                    <span class="cart-icon">(<span id="cart-count"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>)</span>
                </a>
            </li>
            <li><span class="toggle-button" onclick="document.getElementById('toggle-checkbox').click()">
            <img src="images/Hamburger.jpg" width="30" height="30"/>
            </span></li>
        </ul>
    </nav>
</header>

<!-- Navigation -->
<input type="checkbox" id="toggle-checkbox">
<div class="side-panel">
    <h3>Categories</h3>
    <?php
    $stmt = $pdo->query("SELECT DISTINCT category FROM products");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if ($categories) {
        foreach ($categories as $category) : ?>
            <a href="#<?php echo urlencode($category); ?>" class="category-link"><?php echo htmlspecialchars($category); ?></a>
        <?php endforeach;
    }
    ?>
</div>

<div style="text-align: center; margin:0;"class="banner-ad">
    <img src="images/banner.jpg" alt="Special Offer!">
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
    <!-- Popular Products -->
    <h1 style="text-align: center;">Popular Products</h1>
    <div class="product-container">
        <?php foreach ($topProducts as $product) : ?>
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

    <!-- Viewed Products -->
    <h1 style="text-align: center;">Most Viewed Products</h1>
    <div class="product-container">
        <?php foreach ($viewedProducts as $product) : ?>
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

    <div style="text-align: center; margin:1;"class="banner-ad">
    <img src="images/banner4.jpg" alt="Special Offer!">
    </div>

<main>
    <!-- Categories and Products -->
    <?php foreach ($productsByCategory as $category => $categoryProducts) : ?>
        <h2 id="<?php echo urlencode($category); ?>" style="text-align: center;"><?php echo htmlspecialchars($category); ?></h2>
        <section class="products">

        <?php
                $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ?");
                $stmt->execute([$category]);
            $categoryProducts = $stmt->fetchAll();
            
            foreach ($categoryProducts as $product) : ?>

                <div class="product">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </br>
                    <p>Rating: <?php echo htmlspecialchars($product['rate_average']) . ' ( ' . htmlspecialchars($product['rate_count']) . ' ) '; ?></p>
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <select class="product-color">
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                    </select>
                    <select class="product-size">
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                    </select>
                    <p><strong>$<?php echo $product['price']; ?></strong></p>
                    <button class="add-to-cart" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                    <button class="view-more" data-product-id="<?php echo $product['id']; ?>" onclick="window.location.href='product.php?id=<?php echo $product['id']; ?>'">View More</button>
                </div>
                
                
            <?php endforeach; ?>
        </section>
    <?php endforeach; ?>
</main>

<footer>
    This business is fictitious and part of a university course.
</footer>

<script>

</script>


<script src="Javascript/scripts.js"></script>

</body>
</html>
