<?php

namespace Furniture\Hydrators;

use Furniture\Entities\CategoryEntity;
use PDO;

class CategoryHydrator
{
    public static function fetchAllCategories(PDO $db): array
    {
        $query = $db->prepare('SELECT `category_ID` AS `id`, `name`, COUNT(`name`) AS `products` FROM `categories` `c` LEFT JOIN `products` `p` ON `c`.`id` = `p`.`category_ID` GROUP BY `category_ID`');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, CategoryEntity::class);
        return $query->fetchAll();
    }
}