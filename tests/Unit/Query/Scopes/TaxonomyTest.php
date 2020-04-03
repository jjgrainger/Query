<?php

use Query\Builder;
use Query\Scopes\Taxonomy;
use PHPUnit\Framework\TestCase;

class TaxonomyTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new Taxonomy())->apply(new Builder(), 'category', 1);

        $expected = [
            [
                'taxonomy' => 'category',
                'terms'    => [ 1 ],
            ]
        ];

        $this->assertEquals($expected, $builder->getParameter('tax_query'));
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Taxonomy())->apply(new Builder(), 'category', 1);

        $this->assertInstanceOf(Builder::class, $builder);
    }

    public function test_scope_uses_slugs_when_terms_are_string()
    {
        $builder = (new Taxonomy())->apply(new Builder(), 'category', 'news');

        $expected = [
            [
                'taxonomy' => 'category',
                'terms'    => [ 'news' ],
                'field'    => 'slug',
            ]
        ];

        $this->assertEquals($expected, $builder->getParameter('tax_query'));
    }

    public function test_scope_accepts_array()
    {
        $builder = (new Taxonomy())->apply(new Builder(), [
            'taxonomy'         => 'category',
            'terms'            => [ 'news' ],
            'field'            => 'slug',
            'operator'         => 'NOT IN',
            'include_children' => false
        ]);

        $expected = [
            [
                'taxonomy'         => 'category',
                'terms'            => [ 'news' ],
                'field'            => 'slug',
                'operator'         => 'NOT IN',
                'include_children' => false
            ]
        ];

        $this->assertEquals($expected, $builder->getParameter('tax_query'));
    }
}
