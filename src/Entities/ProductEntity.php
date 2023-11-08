<?php

namespace Furniture\Entities;

use JsonSerializable;
use Furniture\Services\CurrencyConverterService;
use Furniture\Exceptions\InvalidCurrencyException;

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

    public function setCurrency(string $currency = 'GBP'): void
    {
        if (!in_array($currency, CurrencyConverterService::VALID_CURRENCIES)) {
            throw new InvalidCurrencyException(InvalidUnitException::INVALID_UNIT);
        }
        $this->currency = $currency;
    }

    public function getPrice()
    {
        return CurrencyConverterService::convertCurrencyFromGBP($this->currency, $this->price);
    }
}