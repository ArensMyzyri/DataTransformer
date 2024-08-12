<?php

namespace App\Tests\Unit\Infrastructure;

class TestModel2
{
    public function __construct(public string $someString, public int $someInt, public array $someArray)
    {
    }
}
