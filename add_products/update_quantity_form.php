<?php

require '../connection/connection.php';
require '../login/users.php';
require 'add_update.php';
require '../templates/header.php';

$connection = connection();

$updateStock = new AddUpdate();
if (!empty($_POST)) {
    $updateStock->updateQuantity($_POST['id'], $_POST['price'], $_POST['stock']);
}

$product = $_GET['id'];

$select = $connection->prepare('SELECT * FROM products WHERE id = :id');
$select->execute([':id' => $product]);
$rows = $select->fetchAll();
?>
<form method="post">
    <fieldset>
        <legend>Update Product</legend>
        <?php foreach ($rows as $_product) : ?>
            <input type="hidden" name="id" value="<?= $_product['id'] ?>"/>
            <label>
                Product Name <input type="text" name="name" value="<?= $_product['name'] ?>" />
            </label><br/><br/>
            <label>
                SKU <input type="text" name="sku" value="<?= $_product['sku'] ?>" />
            </label><br/><br/>
            <label>
                Price <input type="text" name="price" value="<?= $_product['price'] ?>" />
            </label><br/><br/>
            <label>
                Quantity <input type="number" name="stock" value="<?= $_product['stock'] ?>"/>
            </label><br/><br/>
            <label>
                Category <input type="text" name="category" value="<?= $_product['category'] ?>">
            </label>
        <?php endforeach; ?>
            <input type="submit" value="Update Product" />
    </fieldset>
</form>
<?php
require '../templates/footer.php';
