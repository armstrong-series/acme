<?php

declare(strict_types=1);

namespace Acme\WidgetCo;

use Acme\WidgetCo\Basket\Basket;
use Acme\WidgetCo\Models\DeliveryRule;
use Acme\WidgetCo\Models\Offer;
use Acme\WidgetCo\Models\Product;
use Acme\WidgetCo\Services\BasketService;
use Acme\WidgetCo\Services\CalculatorService;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var array<string, callable>
     */
    private array $services = [];

    public function __construct()
    {
        $products = [
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

        $this->set('basket', fn() => new Basket($products));
        $this->set('calculator_service', fn() => new CalculatorService());
        $this->set('basket_service', fn() => new BasketService(
            $this->get('basket'),
            $this->get('calculator_service'),
            $deliveryRules,
            $offers
        ));
    }

    public function get(string $id)
    {
        if (!isset($this->services[$id])) {
            throw new \Exception("Service {$id} not found");
        }
        return $this->services[$id]();
    }

    public function has(string $id): bool
    {
        return isset($this->services[$id]);
    }

    public function set(string $id, callable $factory): void
    {
        $this->services[$id] = $factory;
    }
}