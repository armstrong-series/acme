<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Services;

use Acme\WidgetCo\Models\DeliveryRule;
use Acme\WidgetCo\Models\Offer;
use Acme\WidgetCo\Models\Product;
use Acme\WidgetCo\Contracts\CalculatorContract;

class CalculatorService implements CalculatorContract
{
    /**
     * @param array<string, int> $items
     * @param array<string, Product> $products
     * @param array<int, Offer> $offers
     */
    public function calculateOffer(array $items, array $products, array $offers): float
    {
        $subtotal = 0.0;

        foreach ($items as $productCode => $quantity) {
            if (!isset($products[$productCode])) {
                continue;
            }
            $subtotal += $products[$productCode]->getPrice() * $quantity;
        }

        foreach ($offers as $offer) {
            if ($offer->getProductCode() === 'R01' && isset($items['R01']) && $items['R01'] >= 2) {
                $fullPrice = $products['R01']->getPrice();
                $offerCount = (int) ($items['R01'] / 2);
                $subtotal -= $offerCount * ($fullPrice / 2);
            }
        }

        return $subtotal;
    }

    /**
     * @param array<int, DeliveryRule> $deliveryRules
     */
    public function calculateDelivery(float $subtotal, array $deliveryRules): float
    {
        usort($deliveryRules, fn($a, $b) => $b->getThreshold() <=> $a->getThreshold());
        foreach ($deliveryRules as $rule) {
            if ($subtotal >= $rule->getThreshold()) {
                return $rule->getCost();
            }
        }
        return $deliveryRules[0]->getCost();

    }

    /**
     * @param array<string, int> $items
     * @param array<string, Product> $products
     * @param array<int, Offer> $offers
     * @param array<int, DeliveryRule> $deliveryRules
     */
    public function calculateTotal(array $items, array $products, array $offers, array $deliveryRules): float
    {
        $subtotal = $this->calculateOffer($items, $products, $offers);
        $deliveryCost = $this->calculateDelivery($subtotal, $deliveryRules);
        return $subtotal + $deliveryCost;
    }
}