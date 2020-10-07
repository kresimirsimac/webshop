<?php

require '../connection/connection.php';
require '../login/users.php';
require 'classOrders.php';
require '../templates/header.php';

$connection = connection();

$statement = new Orders();

$rows = $statement->adminView();

?>
    <form method="post" action="all_orders.php">
        <fieldset>
            <legend>Select Order</legend>
            <label>
                Order ID:
                <select name="order_id">
                    <?php foreach ($rows as $_product): ?>
                        <option value="<?= $_product['order_id'] ?>"><?= $_product['order_id'] ?> [<?= $_product['username'] ?>]</option>
                    <?php endforeach; ?>
                </select>
            </label>
            <br/><br/>
            <input type="submit" value="Preview Order"/>
        </fieldset>
    </form>
<?php
require '../templates/footer.php';
