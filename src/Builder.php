<?php

namespace Query;

use \WP_Query;

class Builder
{
    /**
     * The query paramaters
     *
     * @var array
     */
    protected $query;

    /**
     * Constructor.
     *
     * @param array $query
     */
    public function __construct(array $query = [])
    {
        $this->query = $query;
    }

    /**
     * Get the query array.
     *
     * @return array
     */
    public function getParameters(): array
    {
        return $this->query;
    }

    /**
     * Completes the query and returns a \WP_Query object.
     *
     * @return \WP_Query
     */
    public function get(): WP_Query
    {
        return new WP_Query($this->getParameters());
    }

    /**
     * Handle dynamic method calls.
     *
     * @param  string $method
     * @param  array  $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        $this->query[$method] = array_shift($arguments);

        return $this;
    }
}
