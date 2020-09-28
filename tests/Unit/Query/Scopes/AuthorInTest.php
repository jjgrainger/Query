<?php

use Query\Builder;
use Query\Scopes\AuthorIn;
use PHPUnit\Framework\TestCase;

class AuthorInTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new AuthorIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertEquals(['author__in' => [1, 2, 3]], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new AuthorIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
