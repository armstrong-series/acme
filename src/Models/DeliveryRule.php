<?php

declare(strict_types=1);

namespace Acme\WidgetCo\Models;

class DeliveryRule
{
  
    public function __construct(
        private float $threshold, 
        private float $cost
    ){}

    public function getThreshold(): float
    {
        return $this->threshold;
    }

    public function getCost(): float
    {
        return $this->cost;
    }
}
