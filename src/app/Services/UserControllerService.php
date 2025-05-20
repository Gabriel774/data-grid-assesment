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
                label: 'E-mail',
                queryFilter: WhereLikeFilter::class,
                inputType: 'text',
                placeholder: 'Search user by e-mail',
            ),
        ]);
    }

    public function getDataForView(): array
    {
        return [
            'id' => 'user_list',
            'title' => 'User list',
            'filters' => $this->getFilters()->map(fn(FilterTemplate $filterTemplate): array => $filterTemplate->toInterfaceFilter()),
            'get_data_route' => 'api.users.list',
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
