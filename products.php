<?php

require('vendor/autoload.php');

use Furniture\Factories\DbConnector;
use Furniture\Hydrators\ProductHydrator;
use Furniture\Services\ResponseService;
use \Furniture\Exceptions\InvalidCategoryException;

const SUCCESS_MESSAGE = "Successfully retrieved products";

$catId = $_GET['cat'];

try {
    if (!is_numeric($catId)) {
        throw new InvalidCategoryException('INVALID CATEGORY ID');
    }
    $db = DbConnector::getDbConnection();
    $products = ProductHydrator::fetchProductsByCategoryId($db, $catId);
    if (empty($products)) {
        throw new Exception('No products found in database');
    }
    $response = json_encode(ResponseService::createResponse(SUCCESS_MESSAGE, $products));
} catch (InvalidCategoryException $invalidCatEx) {
    $response = json_encode(ResponseService::createResponse(InvalidCategoryException::INVALID_CAT, [], 400));
} catch (Exception $exception) {
    $response = json_encode(ResponseService::createResponse(ResponseService::UNEXPECTED_ERROR, [], 500));
}

echo $response;