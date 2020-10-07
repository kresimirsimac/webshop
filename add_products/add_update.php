<?php
class AddUpdate {

    public function addProduct($name, $sku, $price, $stock, $category) {
        $connection = connection();
        $addProduct = $connection->prepare('INSERT INTO products (name, sku, price, stock, category)
                                           VALUES (:name, :sku, :price, :stock, :category)');
        $addProduct->execute([
            ':name'     => $name,
            ':sku'      => $sku,
            ':price'    => (float)$price,
            ':stock'    => (int)$stock,
            ':category' => $category,
        ]);

    }

    public function updateQuantity($id, $price, $stock) {
        $connection = connection();
        $updateQuantity = $connection->prepare('UPDATE products SET price = :price, stock = :stock WHERE id = :id');
        $updateQuantity->execute([':price' => $price, ':stock' => $stock, ':id' => $id]);

        header('Location: ' . BASE_URL . 'add_products/update_quantity.php');
    }
}