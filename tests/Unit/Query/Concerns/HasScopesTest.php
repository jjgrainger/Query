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

        $params = Query::search('test')->getBuilder()->getParameters();

        $this->assertEquals(['s' => 'test'], $params);
    }
}
