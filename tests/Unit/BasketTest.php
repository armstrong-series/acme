<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Tests\Unit;

use Acme\WidgetCo\Basket\Basket;
use Acme\WidgetCo\Models\Product;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    /** @var array<string, Product> */
    private array $products;

    protected function setUp(): void
    {
        $this->products = [
            'R01' => new Product('R01', 32.95),
            'G01' => new Product('G01', 24.95),
            'B01' => new Product('B01', 7.95),
        ];
    }

    public function testAddItem(): void
    {
        $basket = new Basket($this->products);
        $basket->addItem('R01');
        $this->assertEquals(['R01' => 1], $basket->getItems());
    }

    public function testAddMultipleItems(): void
    {
        $basket = new Basket($this->products);
        $basket->addItem('R01');
        $basket->addItem('R01');
        $basket->addItem('G01');
        $this->assertEquals(['R01' => 2, 'G01' => 1], $basket->getItems());
    }

    public function testInvalidProductThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $basket = new Basket($this->products);
        $basket->addItem('X01');
    }
}