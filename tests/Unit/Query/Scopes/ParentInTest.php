<?php

use Query\Builder;
use Query\Scopes\ParentIn;
use PHPUnit\Framework\TestCase;

class ParentInTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new ParentIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertEquals(['post_parent__in' => [1, 2, 3]], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new ParentIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
