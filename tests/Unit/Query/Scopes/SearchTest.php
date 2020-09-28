<?php

use Query\Builder;
use Query\Scopes\Search;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new Search())->apply(new Builder(), 'search term');

        $this->assertEquals(['s' => 'search term'], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Search())->apply(new Builder(), 'search term');

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
