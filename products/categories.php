<?php

require '../connection/connection.php';
require '../login/users.php';
require 'category.php';
require '../templates/header.php';

$connection = connection();

$showCategory = new Categories();

$result = $showCategory->category();

?>
    <h3><?= $_GET['name'] ?></h3>
    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
        </tr>
        </thead>
        <?php
        foreach ($result as $product) : ?>
        <tbody>
        <tr>
            <td><?= htmlspecialchars($product['product_name']) ?></td>
            <td><?= htmlspecialchars($product['price']) ?></td>
            <td><?= htmlspecialchars($product['stock']) ?></td>
            <td><?= htmlspecialchars($product['category']) ?></td>
            <?php
            if (isset($_SESSION['id'])) {
                echo '<td><a href="../cart/addToCart.php?id='. $product['id'] . '">Add to Cart</a></td>';
            }
            if (isset($_SESSION['id']) && $_SESSION['id'] === '1') {
                echo '<td><a href="'. BASE_URL . 'add_products/update_quantity.php?id='. $product['id'] . '">Update Stock</a></td>';
                echo '<td><a href="'. BASE_URL . 'delete_products/delete_product.php?id='. $product['id'] . '">Delete Product</a></td>';
                echo '<td><a href="'. BASE_URL . 'add_products/update_quantity_form.php?id='. $product['id'] . '">Update Product</a></td>';
            }
            ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table><br/>
<?php
require '../templates/footer.php';
