<?php

require '../connection/connection.php';
require 'classCart.php';

$connection = connection();

$deleteItem = new ThisCart();

$items = $_SESSION['cart'];
$cartItems = explode(',', $_SESSION['cart']);
$deleteItem->delCart($item, $cartItems);
