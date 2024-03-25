<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$productId = $_POST['productId'];
$color = $_POST['color'];
$size = $_POST['size'];

$cartItem = array(
    'id' => $productId,
    'color' => $color,
    'size' => $size
);

$_SESSION['cart'][] = $cartItem;

echo json_encode(array('status' => 'success'));
?>
