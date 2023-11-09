<?php


require('vendor/autoload.php');

use Furniture\Factories\DbConnector;
use Furniture\Hydrators\CategoryHydrator;
use Furniture\Services\ResponseService;
use Furniture\Services\HeaderService;

HeaderService::setHeader();

const SUCCESS_MESSAGE = "Successfully retrieved categories";

try {
    $db = DbConnector::getDbConnection();
    $categories = CategoryHydrator::fetchAllCategories($db);
    if (empty($categories)) {
        throw new Exception(ResponseService::UNEXPECTED_ERROR);
    }
    $response = json_encode(ResponseService::createResponse(SUCCESS_MESSAGE, $categories));
} catch (Exception $exception) {
    $response = json_encode(ResponseService::createResponse($exception->getMessage(), [], 500));
}
echo $response;
