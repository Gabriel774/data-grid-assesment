<?php

namespace App\Filters;

use App\Filters\Contracts\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class WhereDateFilter implements QueryFilter
{
    public function __construct(protected string $column, protected ?string $value)
    {
    }

    public function apply(Builder $query): Builder
    {
        if (is_null($this->value) || $this->value === '') {
            return $query;
        }

        return $query->whereDate($this->column, $this->value);
    }
}
