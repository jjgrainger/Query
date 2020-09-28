<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class PostNotIn implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'post__not_in',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  array   $posts
     *
     * @return Builder
     */
    public function apply(Builder $builder, array $posts = [])
    {
        return $builder->where('post__not_in', $posts);
    }
}
