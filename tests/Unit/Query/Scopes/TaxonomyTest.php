<?php

use Query\Builder;
use Query\Scopes\Taxonomy;
use PHPUnit\Framework\TestCase;

class TaxonomyTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new Taxonomy())->apply(new Builder(), 'category', 1 );

        $expected = [
            [
                'taxonomy'         => 'category',
                'terms'            => 1,
                'field'            => 'term_id',
                'operator'         => 'IN',
                'include_children' => true,
            ]
        ];

        $this->assertEquals($expected, $builder->getParameter('tax_query'));
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Taxonomy())->apply(new Builder(), 'category', 1);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
