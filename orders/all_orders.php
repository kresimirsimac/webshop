<?php

require '../connection/connection.php';
require '../login/users.php';
require 'classOrders.php';
require '../templates/header.php';

$connection = connection();

$userId = $_SESSION['id'];
$orderId = $_POST['order_id'];

if (isset($_SESSION['id']) && $_SESSION['id'] === '1') {
    $orders = new Orders();
    $rows = $orders->ViewOrders($orderId);

?>
    <table>
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Order Placed</th>
        </tr>
        </thead>
        <?php foreach ($rows as $product) : ?>
        <tbody>
        <tr>
            <td><?= $product['order_id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['product_name'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['total'] ?></td>
            <td><?= $product['created'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table><br/><br/>
    <a href="select_orders.php">Preview another order</a>
<?php } else {
    echo 'You do not have permissions to preview all orders. You can only preview orders you placed yourself!';
}
require '../templates/footer.php';
