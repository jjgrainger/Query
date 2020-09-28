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
     *
     * @return Builder
     */
    public function apply(
        Builder $builder,
        $taxonomy = null,
        $terms = []
    ) {
        // Get the tax query array.
        $taxQuery = $builder->getParameter('tax_query', []);

        if (is_array($taxonomy)) {
            $taxQuery[] = $taxonomy;

            return $builder->where('tax_query', $taxQuery);
        }

        // Setup a new tax query clause array.
        $clause = [];

        // Setup the
        $clause['taxonomy'] = $taxonomy;
        $clause['terms'] = (array) $terms;

        // If terms are strings assume they are slugs.
        if (is_string($clause['terms'][0])) {
            $clause['field'] = 'slug';
        }

        // Append the new tax query.
        $taxQuery[] = $clause;

        return $builder->where('tax_query', $taxQuery);
    }
}
