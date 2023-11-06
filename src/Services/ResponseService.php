<?php

namespace Furniture\Services;

class ResponseService
{
    const UNEXPECTED_ERROR = 'Unexpected error';

    public static function createResponse(string $message, array $data): array
    {
        return ['message' => $message, 'data' => $data];

    }
}