<?php

require '../connection/connection.php';
require '../login/users.php';
require 'customer.php';
require '../templates/header.php';

$connection = connection();

$showAll = new Customers();

$result = $showAll->showCustomers();

?>
<table>
    <thead>
    <tr>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Company Name</th>
        <th>Address</th>
        <th>City</th>
        <th>Postal Code</th>
        <th>Country</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $customer) : ?>
    <tr>
        <td><?= $customer['name'] ?></td>
        <td><?= $customer['email'] ?></td>
        <td><?= $customer['username'] ?></td>
        <td><?= $customer['company_name'] ?></td>
        <td><?= $customer['address'] ?></td>
        <td><?= $customer['city'] ?></td>
        <td><?= $customer['postal_code'] ?></td>
        <td><?= $customer['country'] ?></td>
        <td><a href="<?= BASE_URL ?>customers/update_form.php?id=<?= $customer['id'] ?>">Update User</a></td>
        <?php if ($_SESSION['id'] != $customer['id']) : ?>
            <td><a href="<?= BASE_URL ?>customers/delete_customer.php?id=<?= $customer['id'] ?>">Delete User</a></td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
require '../templates/footer.php';
