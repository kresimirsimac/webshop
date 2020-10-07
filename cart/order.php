<?php

require '../connection/connection.php';
require 'classCart.php';

$connection = connection();


foreach ($_SESSION['quantity'] as $id => $quantity) {
    $statement = new ThisCart();

    $statement->orderItems($id, $quantity);
}
unset($_SESSION['cart']);
header('Location: ' . BASE_URL . 'cart/order_placed.php');
exit;