<?php

namespace Furniture\Services;

use JsonSerializable;

class ResponseService
{
    const UNEXPECTED_ERROR = 'Unexpected error';

    public static function createResponse(string $message, array|JsonSerializable $data, int $responseCode = 200): array
    {
        http_response_code($responseCode);
        return ['message' => $message, 'data' => $data];
    }
}
