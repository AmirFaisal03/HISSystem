<?php
session_start();
require 'Database/databaseweb.php';

if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}

// Fetch product information ordered by popularity (descending)
$stmt = $pdo->query("SELECT id, name, price, category, viewed FROM products ORDER BY viewed DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - UrbanVogue Collective</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
<header>
    <a href="admin_dashboard.php" style="text-decoration: none; color: #333;">
        <h1 style="font-family: Garamond, serif; color: white;">&nbsp;&nbsp;-ADMIN- UrbanVogue Collective</h1>
    </a>
</header>

<main>
    <div class="proceed-to-payment">
        <a href="admin_dashboard.php" class="admin-button">Back to Dashboard</a>
    </div>
    <h2>Product Information</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>viewed</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td>$<?php echo $product['price']; ?></td>
                    <td><?php echo $product['category']; ?></td>
                    <td><?php echo $product['viewed']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


            </main>
</body>
</html>
