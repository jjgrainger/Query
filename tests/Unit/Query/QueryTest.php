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

        $this->assertEquals(['limit' => 10], $query->getParameters());
    }

    public function test_query_can_chain_and_proxy_methods_to_builder()
    {
        $query = Query::where('limit', 10)->where('post_type', 'post')->where('fields', 'ids');

        $expected = [
            'limit' => 10,
            'post_type' => 'post',
            'fields' => 'ids',
        ];

        $this->assertEquals($expected, $query->getParameters());
    }

    public function test_query_can_be_passed_through_via_builder_methods()
    {
        $parameters = Query::where('limit', 10)->getParameters();

        $this->assertNotInstanceOf(Query::class, $parameters);
        $this->assertEquals(['limit' => 10], $parameters);
    }

    public function test_query_can_return_builder()
    {
        $builder = Query::where('limit', 10)->getBuilder();

        $this->assertInstanceOf(Builder::class, $builder);
        $this->assertEquals(['limit' => 10], $builder->getParameters());
    }
}
