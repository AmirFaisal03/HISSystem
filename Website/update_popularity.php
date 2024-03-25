<?php
require 'Database/databaseweb.php';

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    $stmt = $pdo->prepare("UPDATE products SET popularity = popularity + 1 WHERE id = ?");
    $stmt->execute([$productId]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Product ID not provided']);
}
?>
