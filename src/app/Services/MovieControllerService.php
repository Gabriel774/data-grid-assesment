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
                    'options' => collect(MovieGenre::cases())->map(fn(MovieGenre $movieGenre) => ucfirst($movieGenre->value))
                ]
            ),
            new FilterTemplate(
                value: 'release_date',
                label: 'Release date',
                queryFilter: WhereDateFilter::class,
                inputType: 'date',
                placeholder: 'Filter movies by release date'
            ),
        ]);
    }

    public function getDataForView(): array
    {
        return [
            'id' => 'movie_list',
            'title' => 'Movie list',
            'filters' => $this->getFilters()->map(fn(FilterTemplate $filterTemplate): array => $filterTemplate->toInterfaceFilter()),
            'table' => [
                'filters' => $this->getFiltersFormatted(),
                'fields' => [
                    'name' => 'Title',
                    'producer_name' => 'Producer ',
                    'genre' => 'Genre',
                    'release_date' => 'Release date',
                    'haters_count' => 'Count of haters',
                    'fans_count' => 'Count of fans',
                ],
            ],

        ];
    }
}
