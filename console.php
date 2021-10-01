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