<?php

use App\Enums\MovieGenre;
use App\Models\Company;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

test('movie factory creates valid movie', function () {
    $movie = Movie::factory()
        ->hasAttached(User::factory()->count(2), ['is_fan' => true], 'userPreferences')
        ->hasAttached(User::factory()->count(3), ['is_fan' => false], 'userPreferences')
        ->create();

    expect($movie)->toBeInstanceOf(Movie::class)
        ->and($movie->name)->toBeString()
        ->and($movie->producer)->toBeInstanceOf(Company::class)
        ->and($movie->synopsis)->toBeString()
        ->and($movie->genre)->toBeInstanceOf(MovieGenre::class)
        ->and($movie->release_date)->toBeInstanceOf(Carbon::class)
        ->and($movie->fans)->toBeInstanceOf(Collection::class)
        ->and($movie->fans)->toHaveCount(2)
        ->and($movie->fans)->each->toBeInstanceOf(User::class)
        ->and($movie->haters)->toBeInstanceOf(Collection::class)
        ->and($movie->haters)->toHaveCount(3)
        ->and($movie->haters)->each->toBeInstanceOf(User::class);
});
