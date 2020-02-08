<?php

namespace Query;

use Query\Builder;

class Query
{
    /**
     * Ther Query Builder object.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * Constructor.
     *
     * @param array $query
     */
    public function __construct(array $query = [])
    {
        $this->builder = new Builder($query);
    }

    /**
     * Handle dynamic static method calls.
     *
     * @param  string $method
     * @param  array  $arguments
     *
     * @return Query
     */
    public static function __callStatic(string $method, array $arguments): Query
    {
        return (new static)->{$method}(...$arguments);
    }

    /**
     * Handle dynamic method calls.
     *
     * @param  string $method
     * @param  array  $arguments
     *
     * @return Query
     */
    public function __call(string $method, array $arguments): Query
    {
        $this->builder->{$method}(...$arguments);

        return $this;
    }
}
