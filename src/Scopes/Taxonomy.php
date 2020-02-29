<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class Taxonomy implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'tax_query',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  string  $taxonomy
     * @param  array   $terms
     * @param  string  $operator
     * @param  string  $field
     * @param  bool    $children
     *
     * @return Builder
     */
    public function apply(
        Builder $builder,
        string $taxonomy = '',
        $terms = [],
        string $operator = 'IN',
        string $field = 'term_id',
        bool $children = true
    ) {
        $taxQuery = $builder->getParameter('tax_query', []);

        $taxQuery[] = [
            'taxonomy' => $taxonomy,
            'terms' => $terms,
            'field' => $field,
            'operator' => $operator,
            'include_children' => $children,
        ];

        return $builder->where('tax_query', $taxQuery);
    }
}
