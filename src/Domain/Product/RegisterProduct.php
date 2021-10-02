<?php

namespace App\Domain\Product;

class RegisterProduct
{
    public function __construct(public int $id, public string $name) {}
}