<?php

namespace App\Services;

use App\Filters\Contracts\QueryFilter;
use App\Filters\FilterTemplate;
use App\Filters\WhereInFilter;
use App\Filters\WhereLikeFilter;
use Illuminate\Support\Collection;

class MovieControllerService
{
    /** @var FilterTemplate[] */
    protected function getFilters(): Collection
    {
        return collect([
            new FilterTemplate(
                value: 'name',
                label: 'Name',
                queryFilter: WhereLikeFilter::class,
                inputType: 'search',
                placeholder: 'Search movie by name'
            ),
            new FilterTemplate(
                value: 'genre',
                label: 'Genre',
                queryFilter: WhereInFilter::class,
                inputType: 'select',
                placeholder: 'Select movie genre'
            ),
            new FilterTemplate(
                value: 'company',
                label: 'Producer',
                queryFilter: WhereInFilter::class,
                inputType: 'select',
                queryColumn: 'producer_id',
                placeholder: 'Select a movie producer'
            )
        ]);
    }

    public function getFiltersForPipeline(): array
    {
        return $this->getFilters()
            ->map(fn(FilterTemplate $filterTemplate): QueryFilter => $filterTemplate->toQueryFilter())
            ->toArray();
    }
}
