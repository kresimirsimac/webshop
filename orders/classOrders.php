<?php

class Orders
{
    public function userOrders($customer) {
        $connection = connection();
        $customer = $_SESSION['id'];
        $statement = $connection->prepare("SELECT * FROM orders INNER JOIN products WHERE orders.product_id = products.id AND customer_id = :customer_id");
        $statement->bindParam(':customer_id', $customer, PDO::PARAM_INT);
        $statement->execute();
        return $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adminView() {
        $connection = connection();
        $stmt = $connection->prepare('SELECT DISTINCT order_id, customer_id, username 
                                                FROM orders INNER JOIN customers WHERE orders.customer_id = customers.id');
        $stmt->execute();
        return $rows = $stmt->fetchAll();
    }

    public function ViewOrders($orderId) {
        $connection = connection();
        $select = $connection->prepare('SELECT * FROM orders
                                                  INNER JOIN customers ON orders.customer_id = customers.id
                                                  INNER JOIN products ON orders.product_id = products.id
                                                  WHERE order_id = :order_id');
        $select->execute([':order_id' => $orderId]);
        return $rows = $select->fetchAll();
    }

}