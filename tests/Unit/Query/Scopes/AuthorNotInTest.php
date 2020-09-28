<?php

use Query\Builder;
use Query\Scopes\AuthorNotIn;
use PHPUnit\Framework\TestCase;

class AuthorNotInTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new AuthorNotIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertEquals(['author__not_in' => [1, 2, 3]], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new AuthorNotIn())->apply(new Builder(), [1, 2, 3]);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
