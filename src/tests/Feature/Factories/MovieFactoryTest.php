<?php

use App\Enums\MovieGenre;
use App\Models\Company;
use App\Models\Movie;
use Illuminate\Support\Carbon;

test('movie factory creates valid movie', function () {
    $movie = Movie::factory()->create();

    expect($movie)->toBeInstanceOf(Movie::class)
        ->and($movie->name)->toBeString()
        ->and($movie->producer)->toBeInstanceOf(Company::class)
        ->and($movie->synopsis)->toBeString()
        ->and($movie->genre)->toBeInstanceOf(MovieGenre::class)
        ->and($movie->release_date)->toBeInstanceOf(Carbon::class);
});