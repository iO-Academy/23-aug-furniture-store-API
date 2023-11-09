<?php

namespace Furniture\Services;

class CurrencyConverterService
{
    const VALID_CURRENCIES = ['GBP', 'USD', 'EUR', 'YEN'];
    const GBP = 1.0;
    const USD = 1.19;
    const EUR = 1.16;
    const YEN = 162.16;

    public static function convertCurrencyFromGBP(string $currency, float $price): float
    {
        switch ($currency) {
            case 'USD':
                $currencyConversion = self::USD;
                break;
            case 'EUR':
                $currencyConversion = self::EUR;
                break;
            case 'YEN':
                $currencyConversion = self::YEN;
                break;
            default:
                $currencyConversion = self::GBP;
        }
        return round($price * $currencyConversion, 2);
    }
}
