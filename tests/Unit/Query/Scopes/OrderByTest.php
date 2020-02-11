<?php

use Query\Builder;
use Query\Scopes\OrderBy;
use PHPUnit\Framework\TestCase;

class OrderByTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new OrderBy())->apply(new Builder(), 'date');

        $this->assertEquals(['order_by' => 'date', 'order' => 'DESC'], $builder->getParameters());
    }

    public function test_scope_applies_parameters_correctly_with_array()
    {
        $builder = (new OrderBy())->apply(new Builder(), ['title' => 'DESC', 'menu_order' => 'ASC']);

        $expected = [
            'order_by' => [
                'title' => 'DESC',
                'menu_order' => 'ASC',
            ],
        ];

        $this->assertEquals($expected, $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new OrderBy())->apply(new Builder(), 10);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
