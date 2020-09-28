<?php

use Query\Builder;
use Query\Scopes\Page;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new Page())->apply(new Builder(), 1);

        $this->assertEquals(['page_id' => 1], $builder->getParameters());
    }

    public function test_scope_applies_parameters_correctly_with_string()
    {
        $builder = (new Page())->apply(new Builder(), 'hello-world');

        $this->assertEquals(['pagename' => 'hello-world'], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Page())->apply(new Builder(), 1);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
