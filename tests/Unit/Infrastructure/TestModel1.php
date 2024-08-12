<?php

namespace App\Tests\Unit\Infrastructure;

readonly class TestModel1
{
    public function __construct(public string $someString, public int $someInt, public array $someArray)
    {
    }
}
