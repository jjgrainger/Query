<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class PostStatus implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'post_status',
        'status',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed   $status
     *
     * @return Builder
     */
    public function apply(Builder $builder, $status = 'publish')
    {
        return $builder->where('post_status', $status);
    }
}
