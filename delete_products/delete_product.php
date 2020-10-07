<?php

require '../connection/connection.php';
require 'delete.php';

$connection = connection();

$deleteProduct = new DeleteProduct();
$deleteProduct->deleteProduct();