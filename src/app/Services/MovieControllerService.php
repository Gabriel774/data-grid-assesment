<?php

namespace App\Services;

use App\Enums\MovieGenre;
use App\Filters\FilterTemplate;
use App\Filters\WhereDateFilter;
use App\Filters\WhereInFilter;
use App\Filters\WhereLikeFilter;
use Illuminate\Support\Collection;

class MovieControllerService extends BaseControllerService
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
                placeholder: 'Search movie by name'
            ),
            new FilterTemplate(
                value: 'genre',
                label: 'Genre',
                queryFilter: WhereInFilter::class,
                inputType: 'select',
                placeholder: 'Select movie genre',
                extra_data: [
                    'options' => collect(MovieGenre::cases())->map->value
                ]
            ),
            new FilterTemplate(
                value: 'release_date',
                label: 'Release date',
                queryFilter: WhereDateFilter::class,
                inputType: 'date',
                queryColumn: 'producer_id',
                placeholder: 'Filter movies by release date'
            )
        ]);
    }
}
