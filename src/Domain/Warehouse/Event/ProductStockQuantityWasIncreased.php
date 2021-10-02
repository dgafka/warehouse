<?php

namespace App\Domain\Warehouse\Event;

class ProductStockQuantityWasIncreased
{
    public function __construct(public string $warehouseId, public string $productId, public int $quantity) {}
}