<?php

use Query\Builder;
use Query\Scopes\Meta;
use PHPUnit\Framework\TestCase;

class MetaTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new Meta())->apply(new Builder(), 'price', '>', 1000, 'NUMERIC');

        $expected = [
            [
                'key' => 'price',
                'value' => 1000,
                'compare' => '>',
                'type' => 'NUMERIC',
            ]
        ];

        $this->assertEquals($expected, $builder->getParameter('meta_query'));
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Meta())->apply(new Builder(), 'Meta term');

        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function test_scope_accepts_key_value_pair()
    {
        $builder = (new Meta())->apply(new Builder(), 'price', 1000);

        $expected = [
            [
                'key' => 'price',
                'value' => 1000,
            ]
        ];

        $this->assertEquals($expected, $builder->getParameter('meta_query'));
    }

    public function test_scope_accepts_an_array()
    {
        $builder = (new Meta())->apply(new Builder(), [
            'key'     => 'price',
            'value'   => 1000,
            'compare' => '>',
            'type'    => 'NUMERIC'
        ]);

        $expected = [
            [
                'key'     => 'price',
                'value'   => 1000,
                'compare' => '>',
                'type'    => 'NUMERIC',
            ]
        ];

        $this->assertEquals($expected, $builder->getParameter('meta_query'));
    }
}
