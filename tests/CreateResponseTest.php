<?php

use PHPUnit\Framework\TestCase;

class CreateResponseTest extends TestCase
{
    public function testCreateResponse_Success()
    {
        $message = 'yeah';
        $data = [10, 23, 99, 87];
        $expected = ['message' => 'yeah', 'data' => [10, 23, 99, 87]];
        $result = \Furniture\Services\ResponseService::createResponse($message, $data);
        $this->assertSame($expected, $result);
    }

    public function testCreateResponse_malformed_param1_array()
    {
        $message = [10, 23, 99, 87];
        $data = [10, 23, 99, 87];
        $this->expectException(TypeError::class);
        \Furniture\Services\ResponseService::createResponse($message, $data);
    }

    public function testCreateResponse_malformed_param2_bool()
    {
        $message = 'nahhhh';
        $data = true;
        $this->expectException(TypeError::class);
        \Furniture\Services\ResponseService::createResponse($message, $data);
    }
}