<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Models;

class Offer
{

    public function __construct(private string $productCode){}
    

    public function getProductCode(): string
    {
        return $this->productCode;
    }

}
