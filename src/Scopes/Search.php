<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class Search implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        's',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  string  $search
     *
     * @return Builder
     */
    public function apply(Builder $builder, string $search = '')
    {
        return $builder->where('s', $search);
    }
}
