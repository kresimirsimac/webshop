<?php

require '../connection/connection.php';
require '../login/users.php';
require 'classCart.php';
require '../templates/header.php';

echo '<h4>Your order has been placed. We will sent you your order details by mail soon.</h4>',
     '<br/>',
     '<a href="../index.php">Continue Shopping</a>',
     '<br/><br/>';

require '../templates/footer.php';
