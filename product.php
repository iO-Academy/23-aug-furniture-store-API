<?php
require('vendor/autoload.php');

use Furniture\Factories\DbConnector;
use Furniture\Hydrators\ProductHydrator;
use Furniture\Services\ResponseService;
use \Furniture\Exceptions\InvalidProductException;
use \Furniture\Exceptions\InvalidUnitException;
use \Furniture\Services\MeasurementConverterService;

const SUCCESS_MESSAGE = "Successfully retrieved product";

$productId = $_GET['id'] ?? '';
$unit = $_GET['unit'] ?? 'mm';
$inStockOnly = $_GET['instockonly'] ?? false;

try {
    if (!is_numeric($productId)) {
        throw new InvalidProductException(InvalidProductException::INVALID_PROD_ID);
    }

    $db = DbConnector::getDbConnection();
    if ($inStockOnly) {
        ProductHydrator::fetchProductsByCategoryIdinStock($db, $productId);
    } else {
        $product = ProductHydrator::fetchProductById($db, $productId);
    }

    $product = ProductHydrator::fetchProductById($db, $productId);
    if (empty($product)) {
        throw new Exception('No product details found in database');
    }
    $product->setMeasurementUnit($unit);
    $response = json_encode(ResponseService::createResponse(SUCCESS_MESSAGE, $product));
} catch (InvalidProductException $invalidProdEx) {
    $response = json_encode(ResponseService::createResponse($invalidProdEx->getMessage(), [], 400));
} catch (InvalidUnitException $invalidUnitEx) {
    $response = json_encode(ResponseService::createResponse($invalidUnitEx->getMessage(), [], 400));
} catch (Exception $exception) {
    $response = json_encode(ResponseService::createResponse(ResponseService::UNEXPECTED_ERROR, [], 500));
}

echo $response;