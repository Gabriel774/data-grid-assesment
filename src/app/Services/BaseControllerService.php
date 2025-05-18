<?php

namespace App\Services;

use App\Filters\Contracts\QueryFilter;
use App\Filters\FilterTemplate;
use Illuminate\Support\Collection;

abstract class BaseControllerService
{
    abstract protected function getFilters(): Collection;
    abstract public function getDataForView(): array;

    public function getFiltersFormatted(bool $forPipeline = false): array
    {
        return $this->getFilters()
            ->map(function (FilterTemplate $filterTemplate) use ($forPipeline): QueryFilter|array {
                return $forPipeline ? $filterTemplate->toQueryFilter() : $filterTemplate->toInterfaceFilter();
            })
            ->toArray();
    }


}
