<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\Contracts\QueryFilter;

class FilterPipeline
{
    /** @var QueryFilter[] */
    protected array $filters = [];

    public function __construct(QueryFilter ...$filters)
    {
        $this->filters = $filters;
    }

    public function applyTo(Builder $query): Builder
    {
        foreach ($this->filters as $filter) {
            $query = $filter->apply($query);
        }

        return $query;
    }
}
