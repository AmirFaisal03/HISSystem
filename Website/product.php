<?php
require 'Database/databaseweb.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($product) ? htmlspecialchars($product['name']) : 'Product Not Found'; ?> - UrbanVogue Collective</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-details {
            display: flex;
            align-items: center;
        }

        .product-details img {
            max-width: 200px;
            margin-right: 20px;
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <a href="index.php" style="text-decoration: none; color: #333;">
        <h1 style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: white;">&nbsp;&nbsp;UrbanVogue Collective</h1>
    </a>
    <nav>
        <ul>
            <li><a href="index.php">&nbsp;&nbsp;Home</a></li>
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
            <a href=" " class="cart-icon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <a href="cart.php">
                <img src="images/shopping-cart.jpg" width="30" height="30"/>
            <a href="cart.php" class="cart-icon">&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="product-details">
        <?php if (isset($product)) : ?>
            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
            <div>
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                <p>Category: <?php echo htmlspecialchars($product['category']); ?></p>

                <button class="view-more" onclick="window.location.href='index.php?id=<?php echo $product['id']; ?>'">Back</button>
                
            </div>
        <?php else : ?>
            <p>Product not found.</p>
        <?php endif; ?>
    </div>
</main>

<footer>
    This business is fictitious and part of a university course.
</footer>

</body>
</html>
