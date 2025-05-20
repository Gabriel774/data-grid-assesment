<?php

namespace App\Filters;

use App\Filters\Contracts\QueryFilter;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

class SortUserFilter implements QueryFilter
{
    public function __construct(protected string $column, protected ?string $value)
    {
    }

    public function apply(Builder $query): Builder
    {
        if (is_null($this->value) || $this->value === '') {
            return $query;
        }

        [$sortColumn, $sortDirection] = explode(',', $this->value);

        return match ($sortColumn) {
            'name', 'email' => $query->orderBy($sortColumn, $sortDirection),
            default => $query
        };
    }
}
