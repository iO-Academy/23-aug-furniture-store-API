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
        return ['id' => $this->id, 'price' => $this->getPrice(), 'stock' => $this->stock, 'color' => $this->color];
    }

    public function setCurrency(string $currency = 'GBP'):void
    {
        if (!in_array($currency, $validCurrency)) {
            throw new InvalidCurrencyException(InvalidUnitException::INVALID_UNIT);
        }
$this->currency= $currency;
    }
    public function getPrice()
    {
        return CurrencyConverterService::convertCurrencyFromGBP($this->currency, $this->price);
    }

}
