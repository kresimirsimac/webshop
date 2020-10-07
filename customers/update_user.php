<?php

require '../connection/connection.php';
require '../login/users.php';
require 'customer.php';
require '../templates/header.php';

$connection = connection();

$id = $_SESSION['id'];

$updateCustomer = new Customers();
if (!empty($_POST)) {
    $updateCustomer->updateCustomer($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['company_name'], $_POST['address'], $_POST['city'], $_POST['postal_code'], $_POST['country'], $id);
}


$update = $connection->prepare('SELECT * FROM customers WHERE id = :id');
$update->bindParam(':id', $id, PDO::PARAM_STR);
$update->execute();
$data = $update->fetch(PDO::FETCH_ASSOC);
?>
    <form method="post">
        <fieldset>
            <legend>Update User info:</legend>
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>
                Name <input type="text" name="name" value="<?= $data['name'] ?>" autofocus />
            </label><br/><br/>
            <label>
                Email <input type="text" name="email" value="<?= $data['email'] ?>" />
            </label><br/><br/>
            <label>
                Username <input type="text" name="username" value="<?= $data['username'] ?>" />
            </label><br/><br/>
            <label>
                Password <input type="password" name="password" placeholder="Keep or Update Your password" />
            </label><br/><br/>
            <label>
                Company Name <input type="text" name="company_name" value="<?= $data['company_name'] ?>" />
            </label><br/><br/>
            <label>
                Address <input type="text" name="address" value="<?= $data['address'] ?>" />
            </label><br/><br/>
            <label>
                City <input type="text" name="city" value="<?= $data['city'] ?>" />
            </label><br/><br/>
            <label>
                Postal Code <input type="number" name="postal_code" value="<?= $data['postal_code'] ?>">
            </label><br/><br/>
            <label>
                Country <input type="text" name="country" value="<?= $data['country'] ?>">
            </label>
            <input type="submit" name="update" value="Update Info">
        </fieldset>
    </form>


<?php
require '../templates/footer.php';
