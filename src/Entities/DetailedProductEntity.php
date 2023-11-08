<?php

namespace Furniture\Entities;

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
            'width' => $this->width,
            'height' => $this->height,
            'depth' => $this->depth,
            'price' => $this->price,
            'stock' => $this->stock,
            'related' => $this->related,
            'color' => $this->color
        ];
    }

    public function setMeasurementUnit(string $unit = 'mm'): void
    {
    }

    public function getWidth()
    {
    }
}
