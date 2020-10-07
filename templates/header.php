<?php
$categories = [
    'Phones',
    'Garden Furnishing',
    'Tools',
    'Vehicles',
];

?>
<html>
<head>
    <title>Webshop</title>
    <div>
        <ul>
            <?php
            if (!empty($_SESSION['id'])) {
                $details = new Users();
                $userDetails = $details->userDetails($_SESSION['id']);
                echo 'Welcome, ' . $userDetails->username . '!', '<br/>';
                    echo '<a href=" ' . BASE_URL . 'login/logout.php">Logout</a>', '<br/>',
                         '<a href=" ' . BASE_URL . 'customers/update_user.php">User Info</a>', '<br/>',
                         '<a href=" ' . BASE_URL . 'orders/orders.php">My Orders</a>', '<br/>',
                         '<a href=" ' . BASE_URL . 'cart/cart.php">Cart</a>', '<br/><br/>';

                if (isset($_SESSION['id']) && $_SESSION['id'] === '1') {
                    echo 'Admin Tools :', '<br/>',
                        '<a href=" ' . BASE_URL .'add_products/add_product.php ">Add Product</a>', '<br/>',
                        '<a href=" ' . BASE_URL .'add_products/update_quantity.php ">Update Product</a>', '<br/>',
                        '<a href=" ' . BASE_URL .'delete_products/delete_product.php ">Delete Product</a>', '<br/>',
                        '<a href=" ' . BASE_URL .'customers/customers.php ">Update Customers</a>', '<br/>',
                        '<a href=" ' . BASE_URL .'orders/select_orders.php ">Select Order to Preview</a>', '<br/>';
                }
            } else {
                echo '<a href=" ' . BASE_URL . 'login/login_form.php">Login</a>', '<br/>',
                     '<a href=" ' . BASE_URL . 'login/register_form.php">Register</a>';
            }
            ?>
        </ul>
        <ul>
                <a href="<?= BASE_URL ?>index.php">Home Page</a><br/>
                <a href="<?= BASE_URL ?>products/all_products.php">All Products</a>
        </ul>
        <ul>Categories
            <?php foreach ($categories as $_category): ?>
                <li>
                    <a href="<?= BASE_URL ?>products/categories.php?name=<?= htmlspecialchars($_category) ?>"><?= $_category ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</head>
<body>
