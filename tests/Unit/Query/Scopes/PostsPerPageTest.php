<?php

use Query\Builder;
use Query\Scopes\PostsPerPage;
use PHPUnit\Framework\TestCase;

class PostsPerPageTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new PostsPerPage())->apply(new Builder(), 10);

        $this->assertEquals(['posts_per_page' => 10], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new PostsPerPage())->apply(new Builder(), 10);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
