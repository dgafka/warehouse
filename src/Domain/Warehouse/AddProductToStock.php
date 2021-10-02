<?php

namespace App\Domain\Warehouse;

class AddProductToStock
{
    public function __construct(public int $warehouseId, public int $productId, public int $quantity) {}
}