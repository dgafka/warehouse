<?php
/** @var ConfiguredMessagingSystem $messagingSystem */

use App\Domain\Product\RegisterProduct;
use App\Domain\Warehouse\AddProductToStock;
use App\Domain\Warehouse\GetCurrentProductQuantity;
use App\Domain\Warehouse\ObserveProduct;
use App\Domain\Warehouse\RegisterWarehouse;
use App\Domain\Warehouse\SubtractProductFromStock;
use Ecotone\Messaging\Config\ConfiguredMessagingSystem;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\EventBus;
use Ecotone\Modelling\QueryBus;

require __DIR__ . "/bootstrap.php";

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);
/** @var EventBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(EventBus::class);


// run your example code here
echo "Registering Product\n";
$commandBus->send(new RegisterProduct(1, "Milk"));
$registeredProductName = $queryBus->sendWithRouting("product.getName", ["id" => 1]);
echo "Registered {$registeredProductName} Product\n";

echo "Registering Warehouse - Milk Shop\n";
$commandBus->send(new RegisterWarehouse(1, "Milk Shop"));
echo "Product milk is now observed in Milk Shop with stock of 100\n";
$commandBus->send(new ObserveProduct(1, 1, 100));

$stockAmount = $queryBus->send(new GetCurrentProductQuantity(1, 1));
echo "Current stock for milk is {$stockAmount}\n";

echo "Increase stock of Milk by 1\n";
$commandBus->send(new AddProductToStock(1, 1, 1));
echo "Decrease stock of Milk by 100\n";
$commandBus->send(new SubtractProductFromStock(1, 1, 100));

$stockAmount = $queryBus->send(new GetCurrentProductQuantity(1, 1));
echo "Current stock for milk is {$stockAmount}\n";

echo "Trying to subtrack more than is in stock. Employee should be informed.\n";
$commandBus->send(new SubtractProductFromStock(1, 1, 2));