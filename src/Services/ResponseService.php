<?php

namespace Furniture\Services;

class ResponseService
{
    const UNEXPECTED_ERROR = 'Unexpected error';

    public static function createResponse(string $message, array $data, int $responseCode = 200): array
    {
        http_response_code($responseCode);
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        return ['message' => $message, 'data' => $data];
    }
}