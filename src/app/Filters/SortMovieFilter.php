<?php

namespace App\Filters;

use App\Filters\Contracts\QueryFilter;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

class SortMovieFilter implements QueryFilter
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
            'name' => $query->orderBy('name', $sortDirection),
            'producer_name' => $query->orderBy(
                Company::select('name')
                    ->whereColumn('companies.id', 'movies.producer_id')
                    ->limit(1),
                $sortDirection
            ),
            'genre' => $query->orderBy('genre', $sortDirection),
            'release_date' => $query->orderBy('release_date', $sortDirection),
            'haters_count' => $query->withCount('haters')->orderBy('haters_count', $sortDirection),
            'fans_count' => $query->withCount('fans')->orderBy('fans_count', $sortDirection),
        };
    }
}
