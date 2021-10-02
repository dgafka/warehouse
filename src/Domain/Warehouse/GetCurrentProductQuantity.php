<?php

namespace App\Domain\Warehouse;

class GetCurrentProductQuantity
{
    public function __construct(public int $warehouseId, public int $productId) {}
}