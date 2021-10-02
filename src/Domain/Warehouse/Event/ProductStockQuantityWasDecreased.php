<?php

namespace App\Domain\Warehouse\Event;

class ProductStockQuantityWasDecreased
{
    public function __construct(public string $warehouseId, public string $productId, public int $quantity) {}
}