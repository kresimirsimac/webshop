<?php

require '../connection/connection.php';
require '../login/users.php';
require 'add_update.php';
require '../templates/header.php';


$connection = connection();

$addProduct = new AddUpdate();

if (!empty($_POST)) {
$addProduct->addProduct($_POST['name'], $_POST['sku'], $_POST['price'], $_POST['stock'], $_POST['category']);
}

?>
<form method="post">
    <fieldset>
        <legend>Add new Product</legend>
        <label>
            Product Name <input type="text" name="name" placeholder="Product Name" required autofocus />
        </label><br/><br/>
        <label>
            SKU <input type="text" name="sku" placeholder="OS1238j" required />
        </label><br/><br/>
        <label>
            Price <input type="text" name="price" placeholder="10.02" required />
        </label><br/><br/>
        <label>
            Quantity <input type="number" name="stock" placeholder="10" required />
        </label><br/><br/>
        <label>
            Category <input type="text" name="category" placeholder="Category" required />
        </label><br/><br/>
        <input type="submit" name="addProd" value="Add Product">
    </fieldset>
</form>
<?php
require '../templates/footer.php';
