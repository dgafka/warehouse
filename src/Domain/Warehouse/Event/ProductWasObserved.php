<?php

namespace App\Domain\Warehouse\Event;

class ProductWasObserved
{
    public function __construct(public string $warehouseId, public string $productId, public int $quantity) {}
}