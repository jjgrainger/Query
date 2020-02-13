<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class PostIn implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'post__in',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  array   $post
     *
     * @return Builder
     */
    public function apply(Builder $builder, array $posts = [])
    {
        return $builder->where('post__in', $posts);
    }
}
