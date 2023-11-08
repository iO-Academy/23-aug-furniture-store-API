<?php

use PHPUnit\Framework\TestCase;
use Furniture\Services\MeasurementConverterService;

class MeasurementConverterTest extends TestCase
{
    public function testConvertMeasurement_Cm_Success()
    {
        $unit = 'cm';
        $value = 15;
        $expected = 1.5;
        $result = MeasurementConverterService::convertMeasurementFromMm($unit, $value);
        $this->assertSame($expected, $result);
    }

    public function testConvertMeasurement_Mm_Success()
    {
        $unit = 'mm';
        $value = 15;
        $expected = 15.0;
        $result = MeasurementConverterService::convertMeasurementFromMm($unit, $value);
        $this->assertSame($expected, $result);
    }

    public function testConvertMeasurement_In_Success()
    {
        $unit = 'in';
        $value = 15;
        $expected = 0.59;
        $result = MeasurementConverterService::convertMeasurementFromMm($unit, $value);
        $this->assertSame($expected, $result);
    }

    public function testConvertMeasurement_Ft_Success()
    {
        $unit = 'ft';
        $value = 15;
        $expected = 0.05;
        $result = MeasurementConverterService::convertMeasurementFromMm($unit, $value);
        $this->assertSame($expected, $result);
    }

    public function testConvertMeasurement_param1Malformed()
    {
        $unit = [];
        $value = 15;
        $this->expectException(TypeError::class);
        MeasurementConverterService::convertMeasurementFromMm($unit, $value);
    }

    public function testConvertMeasurement_param2Malformed()
    {
        $unit = 'ft';
        $value = [];
        $this->expectException(TypeError::class);
        MeasurementConverterService::convertMeasurementFromMm($unit, $value);
    }
}