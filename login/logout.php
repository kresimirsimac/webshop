<?php

include '../connection/connection.php';

$sessionId = '';

$_SESSION['id'] = '';

if (empty($sessionId) && empty($_SESSION['id'])) {
    header('Location: ' . BASE_URL . 'index.php');
}
session_destroy();
