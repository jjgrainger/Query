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
     * Set query parameter.
     *
     * @param  string $key
     * @param  mixed  $value
     *
     * @return Builder
     */
    public function where(string $key, $value)
    {
        $this->query[$key] = $value;

        return $this;
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
}
