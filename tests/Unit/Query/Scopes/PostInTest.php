<?php

use Query\Builder;
use Query\Scopes\PostIn;
use PHPUnit\Framework\TestCase;

class PostInTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new PostIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertEquals(['post__in' => [1, 2, 3]], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new PostIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
