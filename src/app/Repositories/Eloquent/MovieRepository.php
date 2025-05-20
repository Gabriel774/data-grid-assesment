<?php

namespace App\Repositories\Eloquent;

use App\Filters\SortMovieFilter;
use App\Models\Movie;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\MovieRepositoryInterface;

class MovieRepository extends BaseRepository implements MovieRepositoryInterface
{
    protected static function getModel(): Movie
    {
        return new Movie();
    }

    protected static function getAdditionalFilters(): array
    {
        return [new SortMovieFilter('sort', request()->input('sort'))];
    }
}
