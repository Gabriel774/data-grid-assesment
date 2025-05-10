<?php

namespace App\Repositories\Eloquent;

use App\Models\Movie;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\MovieRepositoryInterface;

class MovieRepository extends BaseRepository implements MovieRepositoryInterface
{
    protected static function getModel(): Movie
    {
        return new Movie();
    }
}
