<?php

class Products {

    private $connection;
    private $limit;
    private $offset;

    public function __construct($connection) {
        $this->connection = connection();
    }

    public function allProducts($query) {
        $statement = $this->connection->prepare($query);

        $statement->execute();
        return $statement->fetchAll();
    }
}