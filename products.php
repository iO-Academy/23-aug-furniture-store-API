<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require('vendor/autoload.php');

use Furniture\Factories\DbConnector;
use Furniture\Hydrators\ProductHydrator;
use Furniture\Services\ResponseService;
use \Furniture\Exceptions\InvalidCategoryException;

const SUCCESS_MESSAGE = "Successfully retrieved products";

try {
    if (!is_numeric($_GET['cat'])) {
        throw new InvalidCategoryException('INVALID CATEGORY ID');
    }
    $db = DbConnector::getDbConnection();
    $products = ProductHydrator::fetchProductsByCategoryId($db, $_GET['cat']);
    if (empty($products)) {
        throw new Exception('No products found in database');
    }
    echo json_encode(ResponseService::createResponse(SUCCESS_MESSAGE, $products));
} catch (InvalidCategoryException $invalidCatEx) {
    echo json_encode(ResponseService::createResponse(ResponseService::INVALID_CAT, [], 400));
} catch (Exception $exception) {
    echo json_encode(ResponseService::createResponse(ResponseService::UNEXPECTED_ERROR, [], 500));
}