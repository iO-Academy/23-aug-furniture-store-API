<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require('vendor/autoload.php');

use Furniture\Factories\DbConnector;
use Furniture\Hydrators\Product\Hydrator;
use Furniture\Services\ResponseService;

const SUCCESS_MESSAGE = "Successfully retrieved products";

try {
    $db = DbConnector::getDbConnection();
    $products = ProductHydrator::fetchAllProducts($db);
    if (empty($products)) {
        throw new Exception('No products found in database');
    }
    echo json_encode(ResponseService::createResponse(SUCCESS_MESSAGE, $products));
} catch (Exception $exception) {
    echo json_encode(ResponseService::createResponse(ResponseService::UNEXPECTED_ERROR, [], 500));
}