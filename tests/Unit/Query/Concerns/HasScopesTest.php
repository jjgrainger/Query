<?php

use Query\Query;
use Query\Builder;
use Query\Scope;
use PHPUnit\Framework\TestCase;

class HasScopesTest extends TestCase
{
    public function test_query_has_bootable_scopes()
    {
        $result = Query::search('test')->post_type('event')->getParameters();

        $this->assertEquals(['s' => 'test', 'post_type' => 'event'], $result);
    }

    public function test_query_can_add_scopes_with_scope_class()
    {
        Query::addScope(new \Query\Tests\Unit\Query\Stubs\TestScope);

        $result = Query::test(true)->getParameters();

        $this->assertEquals(['test' => true], $result);
    }

    public function test_query_can_add_scopes_with_closure()
    {
        Query::addScope('test', function (Builder $builder, $var) {
            return $builder->where('test', $var);
        });

        $result = Query::test(true)->getParameters();

        $this->assertEquals(['test' => true], $result);
    }
}
