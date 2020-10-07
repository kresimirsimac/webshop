<?php

require 'connection/connection.php';
require 'login/users.php';
require_once 'templates/header.php';

$connection = connection();

$recent = $connection->prepare('SELECT * FROM products ORDER BY id DESC limit 4');
$recent->execute();
$products = $recent->fetchAll();
?>
    <table>
        <thead>
        <h3>Newest products in our stock: </h3>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Category</th>
        </tr>
        </thead>
        <?php foreach ($products as $product) : ?>
        <tbody>
        <tr>
            <td><?= $product['product_name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['category'] ?></td>
            <?php
            if (isset($_SESSION['id'] $$ $_SESSION['id']!== 1 )) {
                echo '<td><a href=" ' . BASE_URL . ' cart/addToCart.php?id='. $product['id'] . '">Add to Cart</a></td>';
            } ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php
require 'templates/footer.php';
