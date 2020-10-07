<?php

class ThisCart
{

    public function addToCart($id, $cart) {
        if (isset($cart) && !empty($cart)) {
            $items = $cart;
            $cartItems = explode(',', $items);
            $items .= ',' . $id;
            $unique = implode(',', array_unique(explode(',', $items)));
            $_SESSION['cart'] = $unique;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $_SESSION['cart'] = $_GET['id'];
            header('Location: ' . $_SERVER['HTTP_REFERER']);

        }

        // check if in cart - can even be commented out
        $item = $_SESSION['cart'];
        $cartItems = explode(',', $item);
        if (array_intersect_key($cart, $cartItems)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $item .= ',' . $id;
            $_SESSION['cart'] = $item;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function cartItems($id) {
        $connection = connection();
        $statement = $connection->prepare("SELECT * FROM products WHERE id = :id");
        $statement->execute([':id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function delCart($items, $cartItems) {
        if (isset($_GET['remove']) & !empty($_GET['remove'])) {
            $delItem = $_GET['remove'];
            $key = array_search($delItem, $cartItems);
            unset($cartItems[$key]);
            $itemIds = implode(',', $cartItems);
            $_SESSION['cart'] = $itemIds;
        }

        header('Location: ' . BASE_URL . 'cart/cart.php');
    }

    public function orderItems($id, $quantity) {
        $connection = connection();
        $date = date('Y.m.d H:i:s');
        $today = date('Ymd');
        $random = strtoupper(substr(uniqid(sha1(time())), 0, 3));
        $unique = $today . $random;
        $insert = $connection->prepare('INSERT INTO orders (customer_id, product_id, order_id, quantity, total, created) 
                                                  VALUES (:customer_id, :product_id, :order_id, :quantity, :total, :created)');
        $insert->execute([
            ':customer_id' => $_SESSION['id'],
            ':product_id' => $id,
            ':order_id' => $unique,
            ':quantity' => $quantity,
            ':total' => $_SESSION['total'],
            ':created' => $date,
        ]);

        $update = $connection->prepare('UPDATE products SET stock = stock - :quantity WHERE id = :id');
        $update->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $update->bindParam(':id', $id, PDO::PARAM_INT);
        $update->execute([
            ':quantity' => $quantity,
            ':id'       => $id,
        ]);

        $use = $connection->prepare('INSERT INTO order_items (order_id, product_id, quantity)
                            VALUES (:order_id, :product_id, :quantity)');
        $use->execute([
            ':order_id' => $unique,
            ':product_id' => $id,
            ':quantity' => $quantity,
        ]);
    }
}