<?php

namespace Furniture\Entities;

use \Furniture\Services\MeasurementConverterService;

class DetailedProductEntity extends ProductEntity
{
    private int $categoryId;
    private int $width;
    private int $height;
    private int $depth;
    private int $related;
    private string $measurementUnit;

    public function jsonSerialize(): array
    {
        return [
            'categoryId' => $this->categoryId,
            'width' => MeasurementConverterService::convertMeasurement($this->measurementUnit, $this->width),
            'height' => MeasurementConverterService::convertMeasurement($this->measurementUnit, $this->height),
            'depth' => MeasurementConverterService::convertMeasurement($this->measurementUnit, $this->depth),
            'price' => $this->price,
            'stock' => $this->stock,
            'related' => $this->related,
            'color' => $this->color
        ];
    }

    public function setMeasurementUnit(string $unit = 'mm'): void
    {
        $this->measurementUnit = $unit;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getDepth()
    {
        return $this->depth;
    }
}
