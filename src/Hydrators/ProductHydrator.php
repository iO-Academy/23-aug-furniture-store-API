<?php

namespace Furniture\Hydrators;

use Furniture\Entities\ProductEntity;
use Furniture\Entities\DetailedProductEntity;
use PDO;

class ProductHydrator
{
    public static function fetchProductsByCategoryId(PDO $db, int $categoryId): array
    {
        $query = $db->prepare('SELECT `id`, `price`, `stock`, `color` FROM `products` WHERE `category_ID` = ?');
        $query->execute([$categoryId]);
        $query->setFetchMode(PDO::FETCH_CLASS, ProductEntity::class);
        return $query->fetchAll();
    }

    public static function fetchProductById(PDO $db, int $productId): DetailedProductEntity
    {
        $query = $db->prepare('SELECT `category_ID` as `categoryId`, `width`, `height`, `depth`, `price`, `stock`, `related`, `color` FROM `products` WHERE `id` = ?');
        $query->execute([$productId]);
        $query->setFetchMode(PDO::FETCH_CLASS, DetailedProductEntity::class);
        return $query->fetch();
    }

    public static function fetchProductsByCategoryIdInStock(PDO $db, int $categoryId): array {
        $query = $db->prepare('SELECT `id`, `price`, `stock`, `color` FROM `products` WHERE `category_ID` = ?' AND `stock` > 0);
        $query->execute([$categoryId]);
        $query->setFetchMode(PDO::FETCH_CLASS, ProductEntity::class);
        return $query->fetchAll();
}
}
