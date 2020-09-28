<?php

use Query\Builder;
use Query\Scopes\Comments;
use PHPUnit\Framework\TestCase;

class CommentsTest extends TestCase
{
    public function test_scope_applies_parameters_correctly()
    {
        $builder = (new Comments())->apply(new Builder(), 10);

        $this->assertEquals(['comment_count' => 10], $builder->getParameters());
    }

    public function test_scope_returns_builder()
    {
        $builder = (new Comments())->apply(new Builder(), 10);

        $this->assertInstanceOf(Builder::class, $builder);
    }
}
