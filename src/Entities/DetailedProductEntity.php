<?php

namespace Furniture\Entities;

use \Furniture\Services\MeasurementConverterService;
use \Furniture\Exceptions\InvalidUnitException;

class DetailedProductEntity extends ProductEntity
{
    private int $categoryId;
    private int $width;
    private int $height;
    private int $depth;
    private int $related;
    private string $measurementUnit = 'mm';

    public function jsonSerialize(): array
    {
        return [
            'categoryId' => $this->categoryId,
            'width' => $this->getWidth(),
            'height' => $this->getHeight(),
            'depth' => $this->getDepth(),
            'price' => $this->getPrice(),
            'stock' => $this->stock,
            'related' => $this->related,
            'color' => $this->color
        ];
    }

    public function setMeasurementUnit(string $unit): void
    {
        $validUnits = MeasurementConverterService::VALID_UNITS;
        if (!in_array($unit, $validUnits)) {
            throw new InvalidUnitException(InvalidUnitException::INVALID_UNIT);
        }
        $this->measurementUnit = $unit;
    }

    public function getWidth()
    {
        return MeasurementConverterService::convertMeasurementFromMm($this->measurementUnit, $this->width);
    }

    public function getHeight()
    {
        return MeasurementConverterService::convertMeasurementFromMm($this->measurementUnit, $this->height);
    }

    public function getDepth()
    {
        return MeasurementConverterService::convertMeasurementFromMm($this->measurementUnit, $this->depth);
    }
}
