<?php

use Query\Builder;
use Query\Scopes\Post;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new Post())->apply(new Builder(), 1);

        $this->assertEquals(['p' => 1], $builder->getParameters());
    }

    public function test_scope_applies_parameters_correctly_with_string()
    {
        $builder = (new Post())->apply(new Builder(), 'hello-world');

        $this->assertEquals(['name' => 'hello-world'], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Post())->apply(new Builder(), 1);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
