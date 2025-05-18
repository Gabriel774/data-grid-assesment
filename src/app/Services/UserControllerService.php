<?php

namespace App\Services;

use App\Filters\FilterTemplate;
use App\Filters\WhereLikeFilter;
use App\Http\Resources\UserResource;
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

    public function getDataForView(): array
    {
        return [
            'title' => 'User list',
            'table' => [
                'filters' => $this->getFiltersFormatted(),
                'fields' => [
                    'name' => 'Name',
                    'email' => 'E-mail',
                    'favorite_movies' => 'Favorite movies',
                    'hated_movies' => 'Hated movies'
                ],
            ],

        ];
    }
}
