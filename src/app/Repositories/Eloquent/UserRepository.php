<?php

namespace App\Repositories\Eloquent;

use App\Filters\SortUserFilter;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected static function getModel(): User
    {
        return new User();
    }

    protected static function getAdditionalFilters(): array
    {
        return [new SortUserFilter('sort', request()->input('sort'))];
    }
}
