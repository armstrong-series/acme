<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Tests\Unit;

use Acme\WidgetCo\Basket\Basket;
use Acme\WidgetCo\Models\DeliveryRule;
use Acme\WidgetCo\Models\Offer;
use Acme\WidgetCo\Models\Product;
use Acme\WidgetCo\Services\BasketService;
use Acme\WidgetCo\Services\CalculatorService;
use PHPUnit\Framework\TestCase;

class BasketServiceTest extends TestCase
{
    private BasketService $basketService;
    
    /** @var array<string, Product> */
    private array $products;

    protected function setUp(): void
    {
        $this->products = [
            'R01' => new Product('R01', 32.95),
            'G01' => new Product('G01', 24.95),
            'B01' => new Product('B01', 7.95),
        ];
        $deliveryRules = [
            new DeliveryRule(0.0, 4.95),
            new DeliveryRule(50.0, 2.95),
            new DeliveryRule(90.0, 0.0),
        ];
        $offers = [new Offer('R01')];

        $basket = new Basket($this->products);
        $calculator = new CalculatorService();
        $this->basketService = new BasketService($basket, $calculator, $deliveryRules, $offers);
    }

    public function testAddItemAndCalculateTotal(): void
    {
        $this->basketService->addItem('B01');
        $this->basketService->addItem('G01');
        $this->assertEquals(37.85, $this->basketService->calculateTotal());
    }
}