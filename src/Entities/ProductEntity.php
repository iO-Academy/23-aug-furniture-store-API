<?php

namespace Furniture\Entities;

use JsonSerializable;

class ProductEntity implements JsonSerializable
{
    private int $id;
    protected float $price;
    protected int $stock;
    protected string $color;
    protected string $currency;

    public function jsonSerialize(): array
    {
        return ['id' => $this->id, 'price' => $this->price, 'stock' => $this->stock, 'color' => $this->color, 'currency' => $this->currency];
    }
}
