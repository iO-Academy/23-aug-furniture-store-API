<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require('vendor/autoload.php');

use Furniture\Classes\DbConnector;
use Furniture\Classes\CategoryHydrator;
use Furniture\Classes\CategoryEntity;
use Furniture\Services\ResponseService;

$successMessage = "Successfully retrieved categories";

try {
    $db = DbConnector::connectToDb();
    $categories = CategoryHydrator::fetchAllCategories($db);
    echo json_encode(ResponseService::createResponse($successMessage, $categories));
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode(ResponseService::createResponse(ResponseService::UNEXPECTED_ERROR, []));
    exit();
}
