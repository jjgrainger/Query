<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class OrderBy implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'order_by',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed  $key
     * @param  mixed  $order
     *
     * @return Builder
     */
    public function apply(Builder $builder, $key = 'date', $order = 'DESC')
    {
        if (is_array($key)) {
            return $builder->where('order_by', $key);
        }

        return $builder->where('order_by', $key)->where('order', $order);
    }
}
