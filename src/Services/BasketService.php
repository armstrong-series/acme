<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Services;

use Acme\WidgetCo\Basket\Basket;
use Acme\WidgetCo\Models\Offer;
use Acme\WidgetCo\Models\DeliveryRule;
use Acme\WidgetCo\Contracts\CalculatorContract;

class BasketService
{
    public function __construct(
        private readonly Basket $basket,
        private readonly CalculatorContract $calculator,
        /**
         * @var array<int, DeliveryRule>
         */
        private readonly array $deliveryRules,
        /**
         * @var array<int, Offer>
         */
        private readonly array $offers,
    ) {}

    public function addItem(string $productCode): void
    {
        $this->basket->addItem($productCode);
    }

    public function calculateTotal(): float
    {
        

        return $this->calculator->calculateTotal(
            $this->basket->getItems(),
            $this->basket->getProducts(),
            $this->offers,
            $this->deliveryRules
        );
        
        
        
    }
}