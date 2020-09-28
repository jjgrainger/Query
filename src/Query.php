<?php

namespace Query;

use Query\Builder;
use Query\Concerns\HasScopes;

class Query
{
    use HasScopes;

    /**
     * Scopes available to the query.
     *
     * @var array
     */
    protected $scopes = [
        \Query\Scopes\Author::class,
        \Query\Scopes\AuthorIn::class,
        \Query\Scopes\AuthorNotIn::class,
        \Query\Scopes\Comments::class,
        \Query\Scopes\Meta::class,
        \Query\Scopes\Order::class,
        \Query\Scopes\OrderBy::class,
        \Query\Scopes\Page::class,
        \Query\Scopes\ParentIn::class,
        \Query\Scopes\ParentNotIn::class,
        \Query\Scopes\Password::class,
        \Query\Scopes\Post::class,
        \Query\Scopes\PostIn::class,
        \Query\Scopes\PostNotIn::class,
        \Query\Scopes\PostParent::class,
        \Query\Scopes\PostStatus::class,
        \Query\Scopes\PostType::class,
        \Query\Scopes\PostsPerPage::class,
        \Query\Scopes\Search::class,
        \Query\Scopes\Taxonomy::class,
    ];

    /**
     * The Query Builder object.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * The methods that pass through the query object.
     *
     * @var array
     */
    protected $passThrough = [
        'get',
        'getParameters',
    ];

    /**
     * Constructor.
     *
     * @param array $query
     */
    public function __construct(array $query = [])
    {
        $this->buildScopes($this->scopes);

        $this->builder = $this->setup(new Builder($query));
    }

    /**
     * Setup the intiial query.
     *
     * @param  Builder $builder
     *
     * @return Builder
     */
    public function setup(Builder $builder): Builder
    {
        return $builder;
    }

    /**
     * Get the query builder.
     *
     * @return Builder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Handle dynamic static method calls.
     *
     * @param  string $method
     * @param  array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $method, array $arguments)
    {
        return (new static)->{$method}(...$arguments);
    }

    /**
     * Proxy dynamic method calls to the query builder and scopes.
     *
     * @param  string $method
     * @param  array  $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        if ($this->hasScope($method)) {
            $this->builder = $this->callScope($method, array_merge([$this->builder], $arguments));

            return $this;
        }

        $result = $this->builder->{$method}(...$arguments);

        if (in_array($method, $this->passThrough)) {
            return $result;
        }

        return $this;
    }
}
