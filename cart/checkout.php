<?php

require '../connection/connection.php';
require '../login/users.php';
require 'classCart.php';
require '../templates/header.php';

$total = 0.00;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) :
$cartItems = explode(',', $_SESSION['cart']);

?>
<form method="post" action="order.php">
    <table>
        <thead>
        <tr>
            <td>Product</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Subtotal</td>
        </tr>
        </thead>
        <?php
        $connection = connection();
        foreach ($cartItems as $id) {
        $checkout = new ThisCart();
        $item = $checkout->cartItems($id);

        $productName = $item['product_name'];
        $productPrice = $item['price'];
        $quantity = $_POST['quantity'][$id];
        $subtotal = $quantity * $productPrice;
        $total += $subtotal;
        $_SESSION['quantity'] = $_POST['quantity'];
        $_SESSION['price'] = $productPrice;
        ?>
        <tbody>
        <tr>
            <td><?= htmlspecialchars($productName) ?>
                <input type="hidden" name="productName" value="<?= $productName ?>"/>
            </td>
            <td><?= htmlspecialchars($productPrice) ?>
                <input type="hidden" name="productPrice" value="<?= $productPrice ?>"/>
            </td>
            <td><?= htmlspecialchars($quantity) ?>
                <input type="hidden" name="productQuantity" value="<?= $quantity ?>"/>
            </td>
            <td><?= htmlspecialchars($subtotal) ?>
                <input type="hidden" name="subtotal" value="<?= $subtotal ?>"/>
            </td>
        </tr>
        <?php } ?>
        <td>Total: <?= htmlspecialchars($total) ?>
            <input type="hidden" name="total" value="<?= $total ?>"/>
        </td>
        <td><input type="submit" name="order" value="Place Order"/></td>
        <?php endif;
        $_SESSION['subtotal'] = $subtotal;
        $_SESSION['total'] = $total;
        ?>
        </tbody>
    </table>
</form>
<?php
require '../templates/footer.php';
