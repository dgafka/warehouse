<?php
/** @var \Ecotone\Messaging\Config\ConfiguredMessagingSystem $messagingSystem */
require __DIR__ . "/bootstrap.php";

/** @var \Ecotone\Modelling\CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(\Ecotone\Modelling\CommandBus::class);
/** @var \Ecotone\Modelling\QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(\Ecotone\Modelling\QueryBus::class);
/** @var \Ecotone\Modelling\EventBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(\Ecotone\Modelling\EventBus::class);


// run your example code here
$commandBus->send(new \App\Domain\Product\RegisterProduct(1, "Milk"));
var_dump($queryBus->sendWithRouting("product.getName", ["id" => 1]));

$commandBus->send(new \App\Domain\Warehouse\RegisterWarehouse(1, "Milk Shop"));
$commandBus->send(new \App\Domain\Warehouse\ObserveProduct(1, 1, 100));

$commandBus->send(new \App\Domain\Warehouse\AddProductToStock(1, 1, 1));
$commandBus->send(new \App\Domain\Warehouse\SubtractProductFromStock(1, 1, 100));

echo "Current stock should be 1:\n";
var_dump($queryBus->send(new \App\Domain\Warehouse\GetCurrentProductQuantity(1, 1)));

echo "Employee should be informed of out of stock\n";
$commandBus->send(new \App\Domain\Warehouse\SubtractProductFromStock(1, 1, 2));

echo "Current stock should be 1:\n";
var_dump($queryBus->send(new \App\Domain\Warehouse\GetCurrentProductQuantity(1, 1)));