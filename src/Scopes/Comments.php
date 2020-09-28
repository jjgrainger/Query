<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class Comments implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'commentCount',
        'comment_count',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed   $comments
     *
     * @return Builder
     */
    public function apply(Builder $builder, $comments = 0)
    {
        return $builder->where('comment_count', $comments);
    }
}
