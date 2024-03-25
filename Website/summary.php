<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'Database/databaseweb.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: register_login.php");
    exit;
}

$orderDetails = [];

if (isset($_POST['proceedToPayment'])) {
    $deliveryMethod = $_POST['deliveryMethod'];
    $_SESSION['orderDetails'] = [
        'deliveryMethod' => $deliveryMethod,
        'totalCost' => $totalCost, 
        'products' => $_SESSION['cart'], 
    ];

    header('Location: summary.php');
    exit;
} elseif (isset($_SESSION['orderDetails'])) {

    $orderDetails = $_SESSION['orderDetails'];
} else {
    header('Location: cart.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Summary - ClockFace</title>
    <link rel="stylesheet" href="CSS/styles.css">

    <style>
    body {
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
    }

    main {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2, h3 {
        color: #333;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    img {
        margin-right: 20px;
        width: 100px;
        height: 150px; 
    }

    #paymentForm,
    #orderSummary {
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    #paymentForm div,
    #orderSummary div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #333;
        color: white;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
    }

    #orderSummary {
        display: none;
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

            <li>
            <li><a href="previous.php">&nbsp;&nbsp;&nbsp;&nbsp;Previous</a></li>
            <li>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<a href="profile.php">' . $_SESSION['username'] . '</a>' . "&nbsp;&nbsp;&nbsp;";
            } else {
                echo '<a href="register_login.php">Account</a>';
            }
            ?>
        </ul>
    </nav>
</header>

<main>
      <!-- Payment Form -->
      <form action="summary.php" method="post" id="paymentForm" <?php echo isset($_POST['proceedToPayment']) ? 'style="display:none;"' : ''; ?>>
        <div>
            <p style="text-align:center">Thank you for using our website!</p>
            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" name="cardNumber" required>
        </div>
        <div>
            <label for="expiryDate">Expiry Date:</label>
            <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
        </div>
        <div>
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>
        </div>
        <div>
            <input type="submit" value="Make Payment">
        </div>
    </form>

    <div id="orderSummary" <?php echo isset($_POST['proceedToPayment']) ? '' : 'style="display:none;"'; ?>>
        <h2>Payment Summary</h2>
        <p>Delivery Method: <?= htmlspecialchars($orderDetails['deliveryMethod']) ?></p>

        <h3>Products Bought:</h3>
            <ul>
                <?php foreach ($orderDetails['products'] as $cartItem) : ?>
                    <li>
                        <?php if (is_array($cartItem) && count($cartItem) > 0) : ?>
                            <?php
                            $productId = $cartItem['id'];

                            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                            $stmt->execute([$_SESSION['username']]);
                            $user = $stmt->fetch();
                            
                            $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ?");
                            $stmt->execute([$user['id']]);
                            $orders = $stmt->fetchAll();

                            if($orders) {
                                foreach ($orders as $orderID) {
                                    $order = $orderID["id"];                                    
                                }
                            }
                            else {
                                $order = 1;
                            }

                            $stmt = $pdo->prepare("INSERT INTO cart (orderID, userID, prodID, prodColor, prodSize) VALUES (?, ?, ?, ?, ?)");
                            $stmt->execute([$order, $user["id"], $cartItem['id'], $cartItem['color'], $cartItem['size']]);                                   

                            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                            $stmt->execute([$productId]);
                            $product = $stmt->fetch();

                            // Display product information
                            if ($product) {
                                echo '<img src="images/' . $product["image"] . '" alt="" width="50" height="50">';
                                echo $product["name"];
                                foreach ($cartItem as $key => $value) {
                                    echo htmlspecialchars($key) . ': ' . htmlspecialchars($value) . '<br>';
                                }
                            } else {
                                echo 'Product not found.';
                            }
                            ?>
                        <?php else : ?>
                            Product information is not in the expected format.
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        <p>Thank you for your payment!</p>
        <button class="view-more" onclick="window.location.href='index.php?id=<?php echo $product['id']; ?>'">Back</button>               

    </div>

    <script>
        // JavaScript to toggle the visibility of the payment form and order summary
        document.getElementById('paymentForm').addEventListener('submit', function (event) {
            event.preventDefault();
            document.getElementById('paymentForm').style.display = 'none';
            document.getElementById('orderSummary').style.display = 'block';
        });
    </script>

</main>

<footer>
    This business is fictitious and part of a university course.
</footer>

<script src="Javascript/cart_scripts.js"></script>

</body>
</html>
