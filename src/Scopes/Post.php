<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class Post implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'p',
        'name',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed   $limit
     *
     * @return Builder
     */
    public function apply(Builder $builder, $post = null)
    {
        $key = is_int($post) ? 'p' : 'name';

        return $builder->where($key, $post);
    }
}
