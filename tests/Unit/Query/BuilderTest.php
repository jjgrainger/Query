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

    public function test_builder_can_be_instantiated_with_query_array()
    {
        $builder = new Builder(['limit' => 10]);

        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function test_builder_returns_correct_parameters()
    {
        $query = [
            'limit' => 10,
        ];

        $builder = new Builder($query);

        $this->assertEquals($query, $builder->getParameters());
    }
}
