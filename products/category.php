<?php


class Categories {

    public function category()
    {
        $category = $_GET['name'];
        $connection = connection();

        $select = $connection->prepare('SELECT * FROM products WHERE category = :category');
        $select->execute([':category' => $category]);
        return $select->fetchAll();
    }
}