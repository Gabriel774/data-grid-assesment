<?php

namespace App\Services;

use App\Filters\FilterTemplate;
use App\Filters\WhereLikeFilter;
use Illuminate\Support\Collection;

class UserControllerService extends BaseControllerService
{
    /** @var FilterTemplate[] */
    protected function getFilters(): Collection
    {
        return collect([
            new FilterTemplate(
                value: 'name',
                label: 'Name',
                queryFilter: WhereLikeFilter::class,
                inputType: 'text',
                placeholder: 'Search user by name'
            ),
            new FilterTemplate(
                value: 'email',
                label: 'Genre',
                queryFilter: WhereLikeFilter::class,
                inputType: 'text',
                placeholder: 'Select movie genre',
            ),
        ]);
    }
}
