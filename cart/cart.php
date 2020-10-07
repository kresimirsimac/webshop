<?php

require '../connection/connection.php';
require '../login/users.php';
require 'classCart.php';
require '../templates/header.php';

$connection = connection();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cartItems = explode(',', $_SESSION['cart']);
    ?>
    <form method="post" action="checkout.php">
    <table>
    <thead>
    <tr>
        <td>Product</td>
        <td>Price</td>
        <td>Quantity</td>
    </tr>
    </thead>
    <?php
    $connection = connection();
    foreach ($cartItems as $id) {
        $statement = new ThisCart();
        $item = $statement->cartItems($id);
        $productName = $item['product_name'];
        $productPrice = $item['price'];
        ?>
        <tbody>
        <tr>
            <td><?= htmlspecialchars($productName) ?></td>
            <td><?= htmlspecialchars($productPrice) ?></td>
            <td><input type="number" name="quantity[<?= $id ?>]" value="1" min="1" max="<?= $item['stock'] ?>"
                       required/></td>
            <td></td>
            <td><a href="delcart.php?remove=<?= $id ?>">Remove Item</a></td>
        </tr>
    <?php } ?>
    <td><input type="submit" name="checkout" value="Checkout"/></td>
    <?php
    } else {
    echo '<h3>Cart is empty. Add items to start shopping!</h3>';
    }
?>
    </tbody>
    </table>
    </form>
<?php
require '../templates/footer.php';
