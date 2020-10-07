<?php

require '../connection/connection.php';
require '../login/users.php';
require 'add_update.php';
require '../templates/header.php';

$connection = connection();


$select = $connection->prepare('SELECT * FROM products');
$select->execute();
$rows = $select->fetchAll();

?>
<form method="get" action="update_quantity_form.php">
    <fieldset>
        <legend>Update Quantity and Price</legend>
        <select name="id">
            <?php foreach ($rows as $_product): ?>
                    <option value="<?= $_product['id'] ?>"><?= $_product['name'] ?> [<?= $_product['sku'] ?>]</option>
            <?php endforeach; ?>
        </select><br/><br/>
        <input type="submit" value="Select"><br/><br/>
    </fieldset>
</form>
