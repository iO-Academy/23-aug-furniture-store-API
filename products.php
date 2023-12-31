<?php

require('vendor/autoload.php');

use Furniture\Factories\DbConnector;
use Furniture\Hydrators\ProductHydrator;
use Furniture\Services\ResponseService;
use Furniture\Exceptions\InvalidCategoryException;
use Furniture\Services\HeaderService;
use Furniture\Exceptions\InvalidCurrencyException;

HeaderService::setHeader();

const SUCCESS_MESSAGE = "Successfully retrieved products";

$catId = $_GET['cat'] ?? '';
$inStockOnly = $_GET['instockonly'] ?? false;
$inStockOnly = (bool)$inStockOnly;
$currency = $_GET['currency'] ?? 'GBP';

try {
    if (!is_numeric($catId)) {
        throw new InvalidCategoryException(InvalidCategoryException::INVALID_CAT_ID);
    }
    $db = DbConnector::getDbConnection();
    if ($inStockOnly) {
        $products = ProductHydrator::fetchProductsByCategoryIdInStock($db, $catId);
    } else {
        $products = ProductHydrator::fetchProductsByCategoryId($db, $catId);
    }
    if (empty($products)) {
        throw new InvalidCategoryException(InvalidCategoryException::INVALID_CAT_ID);
    }
    foreach ($products as $product) {
        $product->setCurrency($currency);
    }
    $response = json_encode(ResponseService::createResponse(SUCCESS_MESSAGE, $products));
} catch (InvalidCategoryException $invalidCatEx) {
    $response = json_encode(ResponseService::createResponse($invalidCatEx->getMessage(), [], 400));
} catch (InvalidCurrencyException $invalidCurrEx) {
    $response = json_encode(ResponseService::createResponse($invalidCurrEx->getMessage(), [], 400));
} catch (Exception $exception) {
    $response = json_encode(ResponseService::createResponse(ResponseService::UNEXPECTED_ERROR, [], 500));
}

echo $response;
