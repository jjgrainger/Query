<?php

use Query\Query;
use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase
{
    public function test_query_can_be_instantiated()
    {
        $query = new Query();

        $this->assertInstanceOf(Query::class, $query);
    }
}
