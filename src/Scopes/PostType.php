<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class PostType implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'type',
        'post_type'
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed   $type
     *
     * @return Builder
     */
    public function apply(Builder $builder, $type = 'post')
    {
        return $builder->where('post_type', $type);
    }
}
