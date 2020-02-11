<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class PostsPerPage implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'limit',
        'posts_per_page',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  int     $limit
     *
     * @return Builder
     */
    public function apply(Builder $builder, int $limit = 10)
    {
        return $builder->where('posts_per_page', $limit);
    }
}
