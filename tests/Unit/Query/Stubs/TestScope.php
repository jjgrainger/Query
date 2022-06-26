<?php

namespace Query\Tests\Unit\Query\Stubs;

use Query\Scope;
use Query\Builder;

class TestScope implements Scope
{
    public $aliases = [
        'test',
    ];

    public function apply(Builder $builder, $value = '')
    {
        return $builder->where('test', $value);
    }
}
