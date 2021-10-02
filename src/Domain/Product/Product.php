<?php

namespace App\Domain\Product;

use Ecotone\Modelling\Attribute\Aggregate;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\QueryHandler;

#[Aggregate]
class Product
{
    private function __construct(#[AggregateIdentifier] private int $id, private string $name) {}

    #[CommandHandler]
    public static function registerProduct(RegisterProduct $command): static
    {
        return new static($command->id, $command->name);
    }

    #[QueryHandler("product.getName")]
    public function getName(): string
    {
        return $this->name;
    }
}