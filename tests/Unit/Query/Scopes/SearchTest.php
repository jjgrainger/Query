<?php

use Query\Builder;
use Query\Scopes\Search;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    public function test_posts_per_page_scope_applies_scope_correctly()
    {
        $builder = (new Search())->apply(new Builder(), 'search term');

        $this->assertEquals(['s' => 'search term'], $builder->getParameters());
    }

    public function test_posts_per_page_scope_returns_builder()
    {
        $builder = (new Search())->apply(new Builder(), 'search term');

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
