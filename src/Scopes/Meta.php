<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class Meta implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'meta_query',
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
    public function apply(Builder $builder, $key = '', $compare = '=', $value = '', $type = 'CHAR')
    {
        $metaQuery = $builder->getParameter('meta_query', []);

        $metaQuery[] = [
            'key' => $key,
            'value' => $value,
            'compare' => $compare,
            'type' => $type,
        ];

        return $builder->where('meta_query', $metaQuery);
    }
}
