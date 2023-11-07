<?php

namespace Furniture\Entities;

use JsonSerializable;

class ProductEntity implements JsonSerializable
{
    private int $id;
    private float $price;
    private int $stock;
    private string $color;

    public function jsonSerialize(): array
    {
        return ['id' => $this->id, 'price' => $this->price, 'stock' => $this->stock, 'color' => $this->color];
    }
}
