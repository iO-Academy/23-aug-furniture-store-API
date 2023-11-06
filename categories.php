<?php
// used as test

require('vendor/autoload.php');

use Example\Classes\DbConnector;
use Example\Classes\CategoryHydrator;
use Example\Classes\CategoryEntity;

$db = DbConnector::connectToDb();

$categories = CategoryHydrator::fetchAllCategories($db);
foreach ($categories as $category) {
    var_dump($category->jsonSerialize()) . '<br>';
}