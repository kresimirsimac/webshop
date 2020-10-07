<?php

require '../connection/connection.php';
require 'customer.php';

$connection = connection();

$delete = new Customers();
$delete->deleteCustomer();