<?php

namespace Furniture\Services;
class MeasurementConverterService
{
    const VALID_UNITS = ['mm', 'cm', 'in', 'ft'];
    const MM = 1;
    const CM = 10;
    const IN = 25.4;
    const FT = 304.8;

    public static function convertMeasurement(string $unit, int $value):float
    {

        switch ($unit){
            case 'cm':
                $unitConversion = self::CM;
                break;
            case 'in':
                $unitConversion = self::IN;
                break;
            case 'ft':
                $unitConversion = self::FT;
                break;
            default:
                $unitConversion = self::MM;
        }
       return round($value / $unitConversion,2);
    }
}

