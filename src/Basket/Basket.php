<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Basket;
use Acme\WidgetCo\Models\Product;

use InvalidArgumentException;

class Basket
{

     /**
     * @var array<string, int>
     */

    private array $items = [];

    /**
     * @var array<string, Product>
     */
    private array $products;

     /**
     * @param array<string, Product> $products
     */
    public function __construct(array $products)
    {
       
        foreach ($products as $product) {
            $this->products[$product->getCode()] = $product;
        }
    }

    public function addItem(string $productCode): void
    {
        if (!isset($this->products[$productCode])) {
            throw new InvalidArgumentException("Product code {$productCode} not found");
        }
        $this->items[$productCode] = ($this->items[$productCode] ?? 0) + 1;
     
    }

    /**
     * @return array<string, int>
     */

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return array<string, Product>
     */
    public function getProducts(): array
    {
        return $this->products;
    }
}
