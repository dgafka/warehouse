<?php
use DI\Container;
use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\GatewayAwareContainer;
use Ecotone\Messaging\Config\ServiceConfiguration;

$rootCatalog = __DIR__;
require $rootCatalog . "/vendor/autoload.php";

$container = new class() implements GatewayAwareContainer {
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function get($id)
    {
        return $this->container->get($id);
    }

    public function has($id)
    {
        return $this->container->has($id);
    }

    public function set(string $id, object $service)
    {
        $this->container->set($id, $service);
    }

    public function addGateway(string $referenceName, object $gateway): void
    {
        $this->container->set($referenceName, $gateway);
    }
};

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    $container,
    ServiceConfiguration::createWithDefaults()
        ->withLoadCatalog("src"),
    [],
    false
);