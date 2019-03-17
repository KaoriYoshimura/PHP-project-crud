<?php
$dsn = "mysql:host=localhost;dbname=shopping_cart;port=8889;charset=utf8";
$username = "root";
$password = "root";

$pdo = new PDO($dsn, $username, $password);

// Show PDO errors
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Always fetch as associative array
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
