<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Tests\Integration;

use Acme\WidgetCo\Container;
use Acme\WidgetCo\Services\BasketService;
use PHPUnit\Framework\TestCase;

class BasketIntegrationTest extends TestCase
{

    private BasketService $basketService;

    protected function setUp(): void
    {
        $container = new Container();
        $this->basketService = $container->get('basket_service');
    }

    public function testFullBasketWorkflow(): void
    {
        $this->basketService->addItem('B01');
        $this->basketService->addItem('G01');
        $this->assertEquals(37.85, $this->basketService->calculateTotal());

        $this->basketService->addItem('R01');
        $this->basketService->addItem('R01');
        $this->assertEquals(54.37, $this->basketService->calculateTotal());

        $this->basketService->addItem('B01');
        $this->basketService->addItem('B01');
        $this->basketService->addItem('R01');
        $this->assertEquals(98.27, $this->basketService->calculateTotal());
    }
}
