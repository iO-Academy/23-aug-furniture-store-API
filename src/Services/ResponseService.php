<?php

namespace Furniture\Services;

class ResponseService
{
    const UNEXPECTED_ERROR = 'Unexpected error';

    const INVALID_CAT = 'Invalid category id';

    public static function createResponse(string $message, array $data, int $responseCode = 200): array
    {
        http_response_code($responseCode);
        return ['message' => $message, 'data' => $data];
    }
}