<?php

use Query\Builder;
use Query\Scopes\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new Order())->apply(new Builder(), 'ASC');

        $this->assertEquals(['order' => 'ASC'], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Order())->apply(new Builder(), 10);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
