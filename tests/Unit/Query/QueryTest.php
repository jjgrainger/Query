<?php

use Query\Query;
use Query\Builder;
use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase
{
    public function test_query_can_be_instantiated()
    {
        $query = new Query();

        $this->assertInstanceOf(Query::class, $query);
    }

    public function test_query_can_be_instantiated_with_query_array()
    {
        $query = new Query(['limit' => 10]);

        $this->assertInstanceOf(Query::class, $query);
    }

    public function test_query_can_be_instantiated_with_static_call()
    {
        $query = Query::where('limit', 10);

        $this->assertInstanceOf(Query::class, $query);
    }

    public function test_query_can_proxy_methods_to_builder()
    {
        $query = Query::where('limit', 10);

        $this->assertEquals(['limit' => 10], $query->getBuilder()->getParameters());
    }
}
