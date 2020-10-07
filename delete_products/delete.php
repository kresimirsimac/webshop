<?php

class DeleteProduct {

    public function deleteProduct() {
        $connection = connection();
        $deleteProduct = $connection->prepare('DELETE FROM products WHERE id = :id');
        $deleteProduct->execute([':id' => $_GET['id'] ]);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}