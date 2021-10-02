<?php

namespace App\Domain\Warehouse\Event;

class WarehouseWasRegistered
{
    public function __construct(public string $warehouseId, public string $name) {}
}