<?php

use PHPUnit\Framework\TestCase;
use Furniture\Services\CurrencyConverterService;

class CurrencyConverterTest extends TestCase
{
    public function testConvertCurrency_USD_Success()
    {
        $currency = 'USD';
        $price = 15.0;
        $expected = 17.85;
        $result = CurrencyConverterService::convertCurrencyFromGBP($currency, $price);
        $this->assertSame($expected, $result);
    }

    public function testConvertCurrency_EUR_Success()
    {
        $currency = 'EUR';
        $price = 15.0;
        $expected = 17.40;
        $result = CurrencyConverterService::convertCurrencyFromGBP($currency, $price);
        $this->assertSame($expected, $result);
    }

    public function testConvertCurrency_YEN_Success()
    {
        $currency = 'YEN';
        $price = 15.0;
        $expected = 2432.40;
        $result = CurrencyConverterService::convertCurrencyFromGBP($currency, $price);
        $this->assertSame($expected, $result);
    }

    public function testConvertCurrency_GBP_Success()
    {
        $currency = 'GBP';
        $price = 15.0;
        $expected = 15.0;
        $result = CurrencyConverterService::convertCurrencyFromGBP($currency, $price);
        $this->assertSame($expected, $result);
    }

    public function testConvertCurrency_param1Malformed()
    {
        $currency = [];
        $price = 15;
        $this->expectException(TypeError::class);
        CurrencyConverterService::convertCurrencyFromGBP($currency, $price);
    }

    public function testConvertCurrency_param2Malformed()
    {
        $currency = 'USD';
        $price = [];
        $this->expectException(TypeError::class);
        CurrencyConverterService::convertCurrencyFromGBP($currency, $price);
    }
}
