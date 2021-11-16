<?php

namespace App\Domain\Notification;

use App\Domain\Warehouse\Event\ProductWasOutOfStock;
use Ecotone\Modelling\Attribute\EventHandler;

class InformEmployee
{
    #[EventHandler]
    public function when(ProductWasOutOfStock $event): void
    {
        echo "Employee Notification! Product {$event->productId} was out of stock. For order with quantity {$event->quantity}\n";
    }
}