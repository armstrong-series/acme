<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Tests\Unit\Calculator;

use Acme\WidgetCo\Models\DeliveryRule;
use Acme\WidgetCo\Models\Offer;
use Acme\WidgetCo\Models\Product;
use Acme\WidgetCo\Services\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private CalculatorService $calculatorService;

    protected function setUp(): void
    {
        $this->calculatorService = new CalculatorService();
    }

    public function testCalculateOffer(): void
    {
        $products = [
            'R01' => new Product('R01', 32.95),
            'G01' => new Product('G01', 24.95),
        ];
        $offers = [new Offer('R01')];
    
        $items = ['R01' => 2, 'B01' => 1];

        $subtotal = $this->calculatorService->calculateOffer($items, $products, $offers);
        $this->assertEquals(49.425, $subtotal);
    }

    public function testCalculateDelivery(): void
    {
        $rules = [
            new DeliveryRule(0.0, 4.95),
            new DeliveryRule(50.0, 2.95),
            new DeliveryRule(90.0, 0.0),
        ];

        $this->assertEquals(4.95, $this->calculatorService->calculateDelivery(30.0, $rules)); 
        $this->assertEquals(2.95, $this->calculatorService->calculateDelivery(60.0, $rules)); 
        $this->assertEquals(0.0, $this->calculatorService->calculateDelivery(100.0, $rules)); 
    }

    public function testCalculateTotal(): void
    {
        $products = [
            'B01' => new Product('B01', 7.95),
            'G01' => new Product('G01', 24.95),
            'R01' => new Product('R01', 32.95),
        ];
        $deliveryRules = [
            new DeliveryRule(0.0, 4.95),
            new DeliveryRule(50.0, 2.95),
            new DeliveryRule(90.0, 0.0),
        ];
        $offers = [new Offer('R01')];

        $items = ['B01' => 1, 'G01' => 1]; 
        $total = $this->calculatorService->calculateTotal($items, $products, $offers, $deliveryRules);
        $this->assertEquals(37.85, $total);

        $items = ['R01' => 2]; 
        $total = $this->calculatorService->calculateTotal($items, $products, $offers, $deliveryRules);
        $this->assertEquals(54.38, round($total, 2)); 
    }
}
