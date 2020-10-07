<?php

class Users {

    // user log in
    public function userLogin($usernameEmail, $password) {
        try {
            $connection = connection();
            $login = $connection->prepare('SELECT id FROM customers WHERE (username = :usernameEmail or email = :usernameEmail)
                                                     AND password = :hash_password');
            $hashPassword = hash('sha1', $password);
            $login->execute([
                            'usernameEmail' => $usernameEmail,
                            'hash_password' => $hashPassword
                            ]);
            $count = $login->rowCount();
            $data = $login->fetch(PDO::FETCH_OBJ);
            $connection = null;
            if ($count) {
                $_SESSION['id'] = $data->id;
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $e;
        }
    }


    // user register
    public function userRegister($name, $email, $username, $password, $companyName, $address, $city, $postalCode, $country) {
        try {$connection = connection();
        $statement = $connection->prepare('SELECT * FROM customers WHERE username = :username or email = :email');
        $statement->bindParam('username', $username, PDO::PARAM_STR);
        $statement->bindParam('email', $email, PDO::PARAM_STR);
        $statement->execute();
        $count = $statement->rowCount();
        if ($count < 1) {
            $register = $connection->prepare('INSERT INTO customers (name, email, username, password, company_name, address, city, postal_code, country)
                                                        VALUES (:name, :email, :username, :password, :company_name, :address, :city, :postal_code, :country)');
            $hashPassword = hash('sha1', $password);
            $register->execute(['name'         => $name,
                                'email'        => $email,
                                'username'     => $username,
                                'password'     => $hashPassword,
                                'company_name' => $companyName,
                                'address'      => $address,
                                'city'         => $city,
                                'postal_code'  => $postalCode,
                                'country'      => $country
                               ]);
            $id = $connection->lastInsertId();
            $connection = null;
            $_SESSION['id'] = $id;
            return true;
        } else {
            $connection = null;
            return false;
        }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $e;
        }
    }


    // user details
    public function userDetails($id)
    {
        try {
            $connection = connection();
            $user = $connection->prepare('SELECT username FROM customers WHERE id = :id');
            $user->bindParam('id', $id, PDO::PARAM_INT);
            $user->execute();
            $data = $user->fetch(PDO::FETCH_OBJ);  // user data
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }
    }
}
