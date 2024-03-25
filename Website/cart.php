<?php
session_start();
require 'Database/databaseweb.php'; 

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $color = $_POST['color'];
    $size = $_POST['size'];

    $product = [
        'id' => $product_id,
        'name' => 'Product Name',
        'price' => 19.99, 
        'image' => 'product_image.jpg',
    ];

    // Add the item to the cart
    $_SESSION['cart'][] = [
        'id' => $product_id,
        'name' => $product['name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'color' => $color,
        'size' => $size,
    ];

    // Redirect to the summary page
    header('Location: summary.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - UrbanVogue Collective</title>
    <link rel="stylesheet" href="CSS/styles.css">

    <style>
    main {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
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
            <li><a href="MainPage.php">&nbsp;&nbsp;&nbsp;&nbsp;Home</a></li>
            <li>

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
            <a href=" " class="cart-icon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <a href="cart.php">
                <img src="images/shopping-cart.jpg" width="30" height="30"/>
            <a href="cart.php" class="cart-icon">&nbsp;&nbsp;&nbsp;&nbsp;</a></li>

        </ul>
    </nav>
</header>

<main>
    <?php if (empty($_SESSION['cart'])) : ?>
        <p>No cart available</p>
    <?php else : ?>
        <section class="cart-items">
        <?php
        $totalCost = 0;

        echo '<div class="cart-item header">';
        echo '<span>Product Image</span>';
       
        echo '</div>';

        foreach ($_SESSION['cart'] as $key => $cartItem) {
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$cartItem['id']]);
            $product = $stmt->fetch();

            if ($product) {
                $totalCost += $product['price'];

                echo '<div class="cart-item">';
                echo '<img src="images/' . $product["image"] . '" alt="' . $product["name"] . '">';
                echo '<span>' . $product["name"] . '</span>';
                echo '<span>' . $cartItem["color"] . '</span>';
                echo '<span>' . $cartItem["size"] . '</span>';
                echo '<span>$' . $product["price"] . '</span>';
                echo '<button class="delete-from-cart" data-cart-key="' . $key . '">Remove</button>';
                echo '</div>';
            } else {
                echo '<div class="cart-item">';
                echo '<span colspan="5"> ' . $cartItem['id'] . '</span>';
                echo '</div>';
            }
        }
        ?>
    </section>

    <div class="cart-total">
        <strong>Total Cost: $<?= $totalCost ?>&nbsp;&nbsp;&nbsp;&nbsp;</strong>
    </div>

    <form action="checkout_process.php" method="post" id="paymentForm">
    <form action="summary.php" method="post">
        <div class="proceed-to-payment">
            <label for="deliveryMethod">Delivery Method:</label>
            <select id="deliveryMethod" name="deliveryMethod">
                <option value="delivery">Delivery</option>
                <option value="collection">Collection</option>
            </select>
        </div>
        <div>
        <input type="hidden" name="redirect_to_summary" value="true">
        <input type="submit" class="payment-button" value="Proceed to Payment">
        </div>
    </div>
         <?php endif; ?>
</main>

<footer>
    This business is fictitious and part of a university course.
</footer>

<script src="Javascript/cart_scripts.js"></script>

</body>
</html>
