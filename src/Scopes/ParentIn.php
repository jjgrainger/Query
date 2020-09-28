<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class ParentIn implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'postParentIn',
        'post_parent__in',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  array   $parents
     *
     * @return Builder
     */
    public function apply(Builder $builder, array $parents = [])
    {
        return $builder->where('post_parent__in', $parents);
    }
}
