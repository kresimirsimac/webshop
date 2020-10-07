<?php

require '../connection/connection.php';
require '../login/users.php';
require 'classCart.php';
require '../templates/header.php';

$connection = connection();

$addToCart = new ThisCart();

$id = $_GET['id'];
$cart = $_SESSION['cart'];

$addToCart->addToCart($id, $cart);
