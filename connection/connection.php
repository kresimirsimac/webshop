<?php

session_start();

define('BASE_URL', 'http://training.php71.kresimirsimac.dyn.iweb.co.uk/oopPage/');

function connection()
{
    try {
        $connection = new PDO(
            'mysql:host=127.0.0.1; dbname=oop; port=3307', 'root', '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return $connection;
    } catch (PDOException $e) {
        $e->getMessage();
        exit;
    }
}
