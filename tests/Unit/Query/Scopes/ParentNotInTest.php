<?php

use Query\Builder;
use Query\Scopes\ParentNotIn;
use PHPUnit\Framework\TestCase;

class ParentNotInTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new ParentNotIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertEquals(['post_parent__not_in' => [1, 2, 3]], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new ParentNotIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
