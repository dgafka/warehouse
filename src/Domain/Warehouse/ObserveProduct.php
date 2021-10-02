<?php

namespace App\Domain\Warehouse;

class ObserveProduct
{
    public function __construct(public int $warehouseId, public int $productId, public int $quantity) {}
}