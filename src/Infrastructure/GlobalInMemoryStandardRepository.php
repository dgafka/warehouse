<?php

namespace App\Infrastructure;

use Ecotone\Modelling\Attribute\Repository;
use Ecotone\Modelling\InMemoryStandardRepository;

#[Repository]
class GlobalInMemoryStandardRepository extends InMemoryStandardRepository
{

}