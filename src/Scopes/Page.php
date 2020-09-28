<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class Page implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'page_id',
        'pagename',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed   $page
     *
     * @return Builder
     */
    public function apply(Builder $builder, $page = null)
    {
        $key = is_int($page) ? 'page_id' : 'pagename';

        return $builder->where($key, $page);
    }
}
