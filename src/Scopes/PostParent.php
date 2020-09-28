<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class PostParent implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'parent',
        'post_parent',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed   $parent
     *
     * @return Builder
     */
    public function apply(Builder $builder, $parent = 0)
    {
        return $builder->where('post_parent', $parent);
    }
}
