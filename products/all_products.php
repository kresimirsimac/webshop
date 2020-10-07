<?php

require '../connection/connection.php';
require '../login/users.php';
require 'products.php';
require '../products/pagination.php';
require '../templates/header.php';

$connection = connection();

$pagination = new Pagination('products');
$products = $pagination->getData();

$pages = $pagination->getPaginationNumber();

?>
<table>
    <thead>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Category</th>
        <th>Stock</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product) : ?>
    <tr>
        <td><?= htmlspecialchars($product->product_name) ?></td>
        <td><?= htmlspecialchars($product->price) ?></td>
        <td><?= htmlspecialchars($product->category) ?></td>
        <td><?= htmlspecialchars($product->stock) ?></td>
        <?php

        if (isset($_SESSION['id'])) {
            echo '<td><a href=" '. BASE_URL . 'cart/addToCart.php?id='. $product->id . '">Add to Cart</a></td>';
        }
        if (isset($_SESSION['id']) && $_SESSION['id'] === '1') {
            echo '<td><a href="'. BASE_URL . 'add_products/update_quantity.php?id='. $product->id . '">Update Stock</a></td>',
                 '<td><a href="'. BASE_URL . 'delete_products/delete_product.php?id='. $product->id . '">Delete Product</a></td>',
                 '<td><a href="'. BASE_URL . 'add_products/update_quantity_form.php?id='. $product->id . '">Update Product</a></td>';
        }
        $i = 1;
        ?>
    </tr>

    <?php endforeach; ?>
    </tbody>
    <?php for ($i; $i <= $pages; $i++): ?>
        <a href="?page=<?= $i;?>"><?= $i; ?></a>
    <?php endfor; ?>
</table>
<?php
require '../templates/footer.php';
