<?php

namespace Furniture\Services;

class HeaderService
{
    public static function setHeader()
    {
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
    }
}
