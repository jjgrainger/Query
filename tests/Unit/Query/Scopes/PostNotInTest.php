<?php

use Query\Builder;
use Query\Scopes\PostNotIn;
use PHPUnit\Framework\TestCase;

class PostNotInTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new PostNotIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertEquals(['post__not_in' => [1, 2, 3]], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new PostNotIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
