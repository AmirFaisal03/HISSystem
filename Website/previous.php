<?php
session_start();
require 'Database/databaseweb.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: register_login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous Order - UrbanVogue Collective</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    

    <style>
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

        h2,
        h3 {
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
            /* Adjust the width */
            height: 150px;
            /* Adjust the height */
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

        .tabPrevious {
            text-align: center;
            width: 100%;
        }

        .tabPrevious td{
            width: 150px;
            text-align: center;
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
                        echo '<a href="profile.php">' . $_SESSION['username'] . '</a>' . "&nbsp;&nbsp;&nbsp;";
                    } else {
                        echo '<a href="register_login.php">Account</a>';
                    }
                    ?>
                    <li>
            <li><a href="previous.php">&nbsp;&nbsp;&nbsp;&nbsp;Previous</a></li>
            <li>
            </ul>
        </nav>
    </header>

    <?php
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT * FROM cart WHERE userID = ?");
    $stmt->execute([$user['id']]);
    $previousOrders = $stmt->fetchAll();

    if ($previousOrders) {
        ?>
        <table class="tabPrevious">
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product ID</th>
                <th>Product Color</th>
                <th>Product Size</th>
                <th>Order ID</th>
                <th>Rating</th>
            </tr>
            <?php
            foreach ($previousOrders as $order) {
                $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                $stmt->execute([$order['prodID']]);
                $product = $stmt->fetch();

                if ($product) {
                    ?>
                    <tr>
                        <td>
                            <?php echo '<img src="images/' . $product["image"] . '" alt="" width="50" height="50">'; ?>
                        </td>
                        <td>
                            <?php echo $product["name"]; ?>
                        </td>
                        <td>
                            <?php echo $order["prodID"]; ?>
                        </td>
                        <td>
                            <?php echo $order["prodColor"]; ?>
                        </td>
                        <td>
                            <?php echo $order["prodSize"]; ?>
                        </td>
                        <td>
                            <?php echo $order["orderID"]; ?>
                        </td>
                        <td>
                            <?php
                            $stmt = $pdo->prepare("SELECT rating FROM cart WHERE cartID = ?");
                            $stmt->execute([$order['cartID']]);
                            $rateCheck = $stmt->fetch();

                            if ($rateCheck) {
                                if ($rateCheck['rating'] == 0) { ?>
                                    <form action="previous.php" method="post">
                                        <div class="rateyo" data-rateyo-rating="0" data-rateyo-num-stars="5" data-rateyo-score="3">
                                        </div>
                                        <span class="result">Please Rate</span>
                                        <input type="hidden" name="rating">
                                        <input type="hidden" name="cartID" value="<?php echo $order['cartID']; ?>">
                                        <input type="submit" name="add">
                                    </form><?php
                                }
                                else { ?>
                                    <form action="previous.php" method="post">
                                        <div class="rateyo" data-rateyo-rating="<?php echo $rateCheck['rating'] ?>" data-rateyo-num-stars="5" data-rateyo-score="3">
                                        </div>
                                        <span class="result">You have rated this product</span>
                                        <input type="hidden" name="rating">
                                        <input type="hidden" name="cartID" value="<?php echo $order['cartID']; ?>">
                                    </form><?php
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <?php
    } else {
        echo 'No Previous Order';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['rating']) && isset($_POST['cartID'])) {
            $rating = $_POST['rating'];
            $cartID = $_POST['cartID'];

            // Update the cart table with the rating
            $stmt = $pdo->prepare("UPDATE cart SET rating = ? WHERE cartID = ?");
            $success = $stmt->execute([$rating, $cartID]);

            if ($success) {
                echo "New Rate Updated Successfully";

                // Fetch the product ID from the cart
                $stmt = $pdo->prepare("SELECT prodID FROM cart WHERE cartID = ?");
                $stmt->execute([$cartID]);
                $cartData = $stmt->fetch();

                // Set $prodID from the fetched cart data
                $prodID = $cartData['prodID'];

                // Fetch the current rate_count for the product
                $stmt = $pdo->prepare("SELECT rate_count, rate_average FROM products WHERE id = ?");
                $stmt->execute([$prodID]);
                $rateData = $stmt->fetch();

                $currentRateCount = $rateData['rate_count'];
                $currentRateAverage = $rateData['rate_average'];

                // Calculate new rate_count and update rate_count in the products table
                $newRateCount = $currentRateCount + 1;

                // Calculate new total rating by adding the new rating to the existing total
                $stmt = $pdo->prepare("SELECT COALESCE(SUM(rating), 0) AS total_rating FROM cart WHERE prodID = ?");
                $stmt->execute([$prodID]);
                $result = $stmt->fetch();
                $total_rating = $result['total_rating'];

                // Calculate new rate_average by considering the new total rating and count
                $newTotalRating = $total_rating + $rating;
                $newRateAverage = $newTotalRating / $newRateCount;

                // Update rate_count and rate_average in the products table
                $stmt = $pdo->prepare("UPDATE products SET rate_count = ?, rate_average = ? WHERE id = ?");
                $stmt->execute([$newRateCount, $newRateAverage, $prodID]);
            }
        }
    }
    ?>
    <!-- Your JavaScript and closing HTML tags -->
    </main>

    <footer>
        This business is fictitious and part of a university course.
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="Javascript/cart_scripts.js"></script>

    <script>
        $(function () {
            $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
                var rating = data.rating;
                $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
                $(this).parent().find('.result').text('rating :' + rating);
                $(this).parent().find('input[name=rating]').val(rating);
            });
    });
    </script>
</body>

</html>