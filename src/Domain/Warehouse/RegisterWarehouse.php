<?php

namespace App\Domain\Warehouse;

class RegisterWarehouse
{
    public function __construct(public string $warehouseId, public string $name) {}
}