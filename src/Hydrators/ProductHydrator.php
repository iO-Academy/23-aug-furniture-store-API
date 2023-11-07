<?php

namespace Furniture\Hydrators;

use Furniture\Entities\ProductEntity;
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

    public static function fetchProductById(PDO $db, int $productId): ProductEntity
    {
    }
}
