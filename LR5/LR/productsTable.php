<?php
require_once __DIR__ . '/src/helperFunctions.php';
require_once __DIR__ . '/DBconnect.php';
require_once __DIR__ . '/header.php';

$db = DBconnect();
$product = new tableModule($db);
$products =  $product->getAllProducts();
var_dump($products);