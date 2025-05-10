<?php

namespace App\Services;

use App\Filters\Contracts\QueryFilter;
use App\Filters\FilterTemplate;
use Illuminate\Support\Collection;

abstract class BaseControllerService
{
    abstract protected function getFilters(): Collection;

    public function getFiltersForPipeline(): array
    {
        return $this->getFilters()
            ->map(fn(FilterTemplate $filterTemplate): QueryFilter => $filterTemplate->toQueryFilter())
            ->toArray();
    }
}
