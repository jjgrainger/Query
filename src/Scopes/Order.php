<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class Order implements Scope
{
    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed  $key
     * @param  mixed  $order
     *
     * @return Builder
     */
    public function apply(Builder $builder, $order = 'DESC')
    {
        return $builder->where('order', $order);
    }
}
