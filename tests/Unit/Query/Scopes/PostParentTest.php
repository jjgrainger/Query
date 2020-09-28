<?php

use Query\Builder;
use Query\Scopes\PostParent;
use PHPUnit\Framework\TestCase;

class ParentTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new PostParent())->apply(new Builder(), 1);

        $this->assertEquals(['post_parent' => 1], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new PostParent())->apply(new Builder(), 1);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
