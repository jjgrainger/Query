<?php

use Query\Builder;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function test_builder_can_be_instantiated()
    {
        $builder = new Builder();

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
