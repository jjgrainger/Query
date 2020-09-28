<?php

use Query\Builder;
use Query\Scopes\PostStatus;
use PHPUnit\Framework\TestCase;

class PostStatusTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new PostStatus())->apply(new Builder(), 'publish');

        $this->assertEquals(['post_status' => 'publish'], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new PostStatus())->apply(new Builder(), 'publish');

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
