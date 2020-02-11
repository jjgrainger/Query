<?php

use Query\Builder;
use Query\Scopes\PostType;
use PHPUnit\Framework\TestCase;

class PostTypeTest extends TestCase
{
    public function test_post_type_scope_applies_scope_correctly()
    {
        $builder = (new PostType())->apply(new Builder(), 'post');

        $this->assertEquals(['post_type' => 'post'], $builder->getParameters());
    }

    public function test_post_type_scope_returns_builder()
    {
        $builder = (new PostType())->apply(new Builder(), 'post');

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
