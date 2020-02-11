<?php

namespace Query;

use Query\Builder;

class Query
{
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
        'getParameters',
        'get',
    ];

    /**
     * Constructor.
     *
     * @param array $query
     */
    public function __construct(array $query = [])
    {
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
     * Proxy dynamic method calls to the query builder.
     *
     * @param  string $method
     * @param  array  $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        $result = $this->builder->{$method}(...$arguments);

        if (in_array($method, $this->passThrough)) {
            return $result;
        }

        return $this;
    }
}
