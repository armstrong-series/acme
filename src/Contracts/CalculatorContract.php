<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Contracts;

use Acme\WidgetCo\Models\DeliveryRule;
use Acme\WidgetCo\Models\Offer;
use Acme\WidgetCo\Models\Product;


interface CalculatorContract
{

     /**
     * @param array<string, int> $items
     * @param array<int, Offer> $offers
     * @param array<string, Product> $products
     */
    public function calculateOffer(array $items, array $products, array $offers): float;

    /**
     * @param array<int, DeliveryRule> $deliveryRules
     */
    public function calculateDelivery(float $subtotal, array $deliveryRules): float;

    /**
     * @param array<string, int> $items
     * @param array<string, Product> $products
     * @param array<int, Offer> $offers
     * @param array<int, DeliveryRule> $deliveryRules
     */

     public function calculateTotal(array $items, array $products, array $offers, array $deliveryRules): float;
    

}
