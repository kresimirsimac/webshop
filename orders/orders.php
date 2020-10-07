<?php

require '../connection/connection.php';
require '../login/users.php';
require 'classOrders.php';
require '../templates/header.php';

$connection = connection();
$customer = $_SESSION['id'];

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) :
    $orders = new Orders();
    $products = $orders->userOrders($customer);

?>
    <table>
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Order Placed</th>
        </tr>
        </thead>
        <?php foreach ($products as $product) : ?>
        <tbody>
        <tr>
            <td><?= $product['order_id'] ?></td>
            <td><?= $product['product_name'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['total'] ?></td>
            <td><?= $product['created'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>
<?php
include '../templates/footer.php';
