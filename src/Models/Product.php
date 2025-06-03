<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Models;

class Product
{

    public function __construct(
        private string $code, 
        private float $price
    ){}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
