<?php

namespace Furniture\Classes;
class CategoryEntity implements \JsonSerializable
{
    private int $id;
    private string $name;
    private int $products;

    public function jsonSerialize(): array
    {
        return ['id' => $this->id, 'name' => $this->name, 'products' => $this->products];
    }
}