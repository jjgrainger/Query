<?php

namespace Query\Scopes;

use Query\Scope;
use Query\Builder;

class Author implements Scope
{
    /**
     * Aliases for the scope.
     *
     * @var array
     */
    public $aliases = [
        'author',
        'author_name',
        'authorName',
    ];

    /**
     * Apply the scope to the query builder.
     *
     * @param  Builder $builder
     * @param  mixed   $author
     *
     * @return Builder
     */
    public function apply(Builder $builder, $author = 1)
    {
        // Use the author key by default.
        $key = 'author';

        // If the author passed is a string and is not a comma separated string of author ids
        if (is_string($author) && strpos($author, ',') === false) {
            $key = 'author_name';
        }

        return $builder->where($key, $author);
    }
}
