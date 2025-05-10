<?php

namespace Tests\Stubs;

use App\Filters\Contracts\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class DummyFilter implements QueryFilter
{
    public function __construct(public string $column, public string $value)
    {
    }

    public function apply(Builder $query): Builder
    {
        return $query;
    }
}
