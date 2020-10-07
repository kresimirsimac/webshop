<?php

$connection = mysqli_connect('127.0.0.1', 'root', '', 'oop', 3307);
if (!$connection) {
    die('Could not connect: ' . mysqli_connect_error());
}

$fileName = isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'] : '';

$file = fopen($fileName, 'r');
$column = fgetcsv($file, 1000);

while (($column = fgetcsv($file, 1000, ';')) !== false) {
    $insertQuery = "INSERT INTO products (id, name, sku, price, stock, category)
                    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $insertQuery);
    mysqli_stmt_bind_param(
        $stmt,
        'ssssss',
        $column[0],
        $column[1],
        $column[2],
        $column[3],
        $column[4],
        $column[5]
    );
    mysqli_stmt_execute($stmt);
}

fclose($file);

exit;
