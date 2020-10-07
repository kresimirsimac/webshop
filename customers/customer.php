<?php

class Customers {

    public function deleteCustomer() {
        $connection = connection();
        $deleteCustomer = $connection->prepare('DELETE FROM customers WHERE id = :id');
        $deleteCustomer->execute([':id' => $_GET['id']]);
        header('Location: ' . BASE_URL . 'customers/customers.php');
    }

    public function updateCustomer($name, $email, $username, $password, $companyName, $address, $city, $postalCode, $country, $id) {
        $connection = connection();

        $password = $hashPassword = hash('sha1', $_POST['password']);

        $updateCustomer = $connection->prepare('UPDATE customers SET 
                                                name = :name,
                                                email = :email,
                                                username = :username,
                                                password = :password,
                                                company_name = :company_name,
                                                address = :address,
                                                city = :city,
                                                postal_code = :postal_code,
                                                country = :country
                                                WHERE id = :id');
        $updateCustomer->execute([
            ':name'         => $name,
            ':email'        => $email,
            ':username'     => $username,
            ':password'     => $password,
            ':company_name' => $companyName,
            ':address'      => $address,
            ':city'         => $city,
            ':postal_code'  => $postalCode,
            ':country'      => $country,
            ':id'           => $id,
        ]);
        if (isset($_SESSION['id']) && $_SESSION['id'] === 1) {
            header('Location: ' . BASE_URL . 'customers/customers.php');
        } else {
            header('Location: ' . BASE_URL . 'index.php');
        }
    }

    public function showCustomers() {
        $connection = connection();
        $showAll = $connection->prepare('SELECT * FROM customers');
        $showAll->execute();
        return $showAll->fetchAll();
    }
}