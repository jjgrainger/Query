<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class AuthorNotIn implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'author__not_in',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  array   $authors
     *
     * @return Builder
     */
    public function apply(Builder $builder, array $authors = [])
    {
        return $builder->where('author__not_in', $authors);
    }
}
