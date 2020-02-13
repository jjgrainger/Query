<?php

use Query\Builder;
use Query\Scopes\Author;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new Author())->apply(new Builder(), 1);

        $this->assertEquals(['author' => 1], $builder->getParameters());
    }

    public function test_scope_applies_parameters_correctly_with_string()
    {
        $builder = (new Author())->apply(new Builder(), 'admin');

        $this->assertEquals(['author_name' => 'admin'], $builder->getParameters());
    }

    public function test_scope_applies_parameters_correctly_with_comma_separated_string()
    {
        $builder = (new Author())->apply(new Builder(), '1,2,3');

        $this->assertEquals(['author' => '1,2,3'], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Author())->apply(new Builder(), 1);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
