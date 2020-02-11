<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class Password implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'has_password',
        'post_password',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed   $password
     *
     * @return Builder
     */
    public function apply(Builder $builder, $password = false)
    {
        $key = is_bool($password) ? 'has_password' : 'post_password';

        return $builder->where($key, $password);
    }
}
