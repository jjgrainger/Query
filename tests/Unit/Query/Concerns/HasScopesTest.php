<?php

use Query\Query;
use Query\Builder;
use Query\Scope;
use PHPUnit\Framework\TestCase;

class HasScopesTest extends TestCase
{
    public function test_query_can_add_scopes()
    {
        Query::addScope(\Query\Scopes\Search::class);

        $result = Query::search('test')->getParameters();

        $this->assertEquals(['s' => 'test'], $result);
    }

    public function test_query_has_bootable_scopes()
    {
        $result = Query::search('test')->post_type('event')->getParameters();

        $this->assertEquals(['s' => 'test', 'post_type' => 'event'], $result);
    }
}
