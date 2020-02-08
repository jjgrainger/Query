<?php

namespace Query;

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
     * Handle dynamic method calls.
     *
     * @param  string $method
     * @param  array  $arguments
     *
     * @return Builder
     */
    public function __call(string $method, array $arguments): Builder
    {
        $this->query[$method] = array_shift($arguments);

        return $this;
    }
}
