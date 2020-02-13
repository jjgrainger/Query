<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class AuthorIn implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'author__in',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  array   $author
     *
     * @return Builder
     */
    public function apply(Builder $builder, array $authors = [])
    {
        return $builder->where('author__in', $authors);
    }
}
