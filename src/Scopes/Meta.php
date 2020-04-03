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
     * @param  string  $key
     * @param  string  $compare
     * @param  mixed   $value
     * @param  string  $type
     *
     * @return Builder
     */
    public function apply(Builder $builder, $key = '', $compare = '=', $value = '', $type = false)
    {
        $metaQuery = $builder->getParameter('meta_query', []);

        if (is_array($key)) {
            $metaQuery[] = $key;

            return $builder->where('meta_query', $metaQuery);
        }

        $clause = [];

        $clause['key'] = $key;

        // If only key and compare were passed, assume compare is the value.
        if (3 === func_num_args()) {
            $clause['value'] = $compare;
        } else {
            $clause['value'] = $value;
            $clause['compare'] = $compare;

            if (!empty($type)) {
                $clause['type'] = $type;
            }
        }

        $metaQuery[] = $clause;

        return $builder->where('meta_query', $metaQuery);
    }
}
