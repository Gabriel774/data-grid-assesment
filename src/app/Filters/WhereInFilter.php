<?php

namespace App\Filters;

use App\Filters\Contracts\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class WhereInFilter implements QueryFilter
{
    protected array $values;

    public function __construct(protected string $column, ?string $rawValues)
    {
        $this->values = $rawValues ? explode(',', $rawValues) : [];
    }

    public function apply(Builder $query): Builder
    {
        if (empty($this->values)) {
            return $query;
        }

        return $query->whereIn($this->column, $this->values);
    }
}
