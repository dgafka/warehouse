<?php

namespace App\Infrastructure;

use Ecotone\Modelling\Attribute\Repository;
use Ecotone\Modelling\InMemoryEventSourcedRepository;

#[Repository]
class GlobalInMemoryEventSourcingRepository extends InMemoryEventSourcedRepository
{

}