<?php

namespace Query;

use Query\Builder;

interface Scope
{
    public function apply(Builder $builder);
}
