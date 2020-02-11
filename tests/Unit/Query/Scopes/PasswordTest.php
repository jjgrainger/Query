<?php

use Query\Builder;
use Query\Scopes\Password;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $passwordScope = new Password();

        $true     = $passwordScope->apply(new Builder(), true)->getParameters();
        $false    = $passwordScope->apply(new Builder(), false)->getParameters();
        $password = $passwordScope->apply(new Builder(), 'secret')->getParameters();

        $this->assertEquals(['has_password' => true], $true);
        $this->assertEquals(['has_password' => false], $false);
        $this->assertEquals(['post_password' => 'secret'], $password);
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Password())->apply(new Builder(), 10);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
