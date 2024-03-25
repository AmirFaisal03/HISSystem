<?php
session_start();
require 'Database/databaseweb.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: register_login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch();

foreach ($_SESSION['cart'] as $product) {
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_name) VALUES (?, ?)");
    $stmt->execute([$user['id'], $product]);
    $insertOrder = $stmt->fetch();

    if ($insertOrder) {
        $orderID = $_GET['order_id'];
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE orderID = $orderID");
        $stmt->execute([$user['id'], $product]);
        $orderItems = $stmt->fetchAll();
    }
}

$_SESSION['orderDetails'] = [
    'deliveryMethod' => $_POST['deliveryMethod'],
    'totalCost' => $totalCost,
    'products' => $_SESSION['cart'],
];

$_SESSION['cart'] = [];


header('Location: summary.php');
exit;
?>