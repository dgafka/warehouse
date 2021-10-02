<?php

namespace App\Domain\Warehouse\Event;

class ProductWasOutOfStock
{
    public function __construct(public string $warehouseId, public string $productId, public int $quantity) {}
}