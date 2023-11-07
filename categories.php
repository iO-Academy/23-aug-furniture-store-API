<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require('vendor/autoload.php');

use Furniture\Factories\DbConnector;
use Furniture\Hydrators\CategoryHydrator;
use Furniture\Services\ResponseService;

const SUCCESS_MESSAGE = "Successfully retrieved categories";

try {
    $db = DbConnector::getDbConnection();
    $categories = CategoryHydrator::fetchAllCategories($db);
    if (empty($categories)) {
        throw new Exception('No categories found in database');
    }
    echo json_encode(ResponseService::createResponse(SUCCESS_MESSAGE, $categories));
} catch (Exception $exception) {
    http_response_code(500);
    echo json_encode(ResponseService::createResponse(ResponseService::UNEXPECTED_ERROR, []));
}
