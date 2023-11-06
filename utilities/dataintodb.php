<?php
$host = 'db';
$db = 'furniture';
$user = 'root';
$password = 'password';

$dsn = "mysql:host=$host;dbname=$db;";

$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$rawData = file_get_contents('docs/furniturerawdata');

$decodedData = json_decode($rawData);
$categories =
    [1 => 'Chair', 2 => 'Office Chair', 3 => 'Book case', 4 => 'Table', 5 => 'Draws', 6 => 'Wardrobe', 7 => 'Chest', 8 => 'TV Stand', 9 => 'Shelves', 10 => 'Desk', 11 => 'Sofa'];

foreach ($decodedData as $value) {
    $categoryId = array_search($value->name, $categories);
    $price = ltrim($value->price, '£');
    $query = $pdo->prepare("INSERT INTO `products` (`category_ID`, `width`, `height`, `depth`, `price`, `stock`, `related`, `color`) VALUES ($categoryId, $value->width, $value->height, $value->depth, $price, $value->stock, $value->related, ?);");
    $query->execute([$value->color]);
}