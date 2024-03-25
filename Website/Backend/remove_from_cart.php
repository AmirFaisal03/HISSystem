<?php
session_start();

if (isset($_POST['cartKey']) && isset($_SESSION['cart'][$_POST['cartKey']])) {
    unset($_SESSION['cart'][$_POST['cartKey']]);
    echo json_encode(array('status' => 'success'));
} else {
    echo json_encode(array('status' => 'error'));
}
?>
