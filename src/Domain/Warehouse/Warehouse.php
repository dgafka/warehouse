<?php

namespace App\Domain\Warehouse;

use App\Domain\Warehouse\Event\ProductStockQuantityWasDecreased;
use App\Domain\Warehouse\Event\ProductStockQuantityWasIncreased;
use App\Domain\Warehouse\Event\ProductWasObserved;
use App\Domain\Warehouse\Event\ProductWasOutOfStock;
use App\Domain\Warehouse\Event\WarehouseWasRegistered;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\Attribute\QueryHandler;
use Ecotone\Modelling\WithAggregateEvents;
use Ecotone\Modelling\WithAggregateVersioning;

#[EventSourcingAggregate]
class Warehouse
{
    #[AggregateIdentifier]
    private int $warehouseId;
    private array $stock = [];

    use WithAggregateVersioning;

    public function __construct() {}

    #[CommandHandler]
    public static function register(RegisterWarehouse $command): array
    {
        return [new WarehouseWasRegistered($command->warehouseId, $command->name)];
    }

    #[CommandHandler]
    public function observeProduct(ObserveProduct $command): array
    {
        return [new ProductWasObserved($command->warehouseId, $command->productId, $command->quantity)];
    }

    #[CommandHandler]
    public function addProductToStock(AddProductToStock $command): array
    {
        return [new ProductStockQuantityWasIncreased($command->warehouseId, $command->productId, $command->quantity)];
    }

    #[CommandHandler]
    public function subtrackProductFromStock(SubtractProductFromStock $command): array
    {
        if ($this->stock[$command->productId] < $command->quantity) {
            return [new ProductWasOutOfStock($command->warehouseId, $command->productId, $command->quantity)];
        }

        return [new ProductStockQuantityWasDecreased($command->warehouseId, $command->productId, $command->quantity)];
    }

    #[EventSourcingHandler]
    public function applyWarehouseWasRegistered(WarehouseWasRegistered $event): void
    {
        $this->warehouseId = $event->warehouseId;
    }

    #[EventSourcingHandler]
    public function applyProductWasObserved(ProductWasObserved $event): void
    {
        $this->stock[$event->productId] = $event->quantity;
    }

    #[EventSourcingHandler]
    public function applyProductStockQuantityWasDecreased(ProductStockQuantityWasDecreased $event): void
    {
        $this->stock[$event->productId] -= $event->quantity;
    }

    #[EventSourcingHandler]
    public function applyProductStockQuantityWasIncreased(ProductStockQuantityWasIncreased $event): void
    {
        $this->stock[$event->productId] += $event->quantity;
    }

    #[QueryHandler]
    public function getCurrentProductQuantity(GetCurrentProductQuantity $query): int
    {
        return $this->stock[$query->productId];
    }
}