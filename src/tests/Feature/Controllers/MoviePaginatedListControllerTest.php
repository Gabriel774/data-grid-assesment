<?php

use App\Enums\MovieGenre;
use App\Models\Movie;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

uses(RefreshDatabase::class);

test('movie list returns paginated list of movies using resource', function () {
    Movie::factory()
        ->count(2)
        ->for(Company::factory()->create(), 'producer')
        ->hasAttached(User::factory()->count(3), ['is_fan' => true], 'userPreferences')
        ->hasAttached(User::factory(), ['is_fan' => false], 'userPreferences')
        ->create();

    $response = $this->getJson(route('api.movies.list'));

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'producer_name',
                    'genre',
                    'release_date',
                    'fans_count',
                    'haters_count',
                ],
            ],
            'links',
            'meta'
        ])
        ->assertJson(
            fn(AssertableJson $json) =>
            $json->has('data', 2)
                ->where('data.0.fans_count', 3)
                ->where('data.0.haters_count', 1)
                ->etc()
        );
});

test('it filters movies by genre in MovieListController', function () {
    $company = Company::factory()->create();

    Movie::factory()->for($company, 'producer')->create(['genre' => MovieGenre::COMEDY]);
    Movie::factory()->count(2)->for($company, 'producer')->create(['genre' => MovieGenre::ACTION]);

    $response = $this->getJson(route('api.movies.list', ['genre' => MovieGenre::ACTION->value]));

    $response
        ->assertOk()
        ->assertJson(
            fn(AssertableJson $json) =>
            $json->has('data', 2)
                ->has('data.0.genre')
                ->has('meta')
                ->has('links')
                ->etc()
        );
});

test('it filters movies by name in MovieListController', function () {
    $company = Company::factory()->create();

    Movie::factory()->for($company, 'producer')->create(['name' => 'The Dark Knight']);
    Movie::factory()->for($company, 'producer')->create(['name' => 'The Godfather']);
    Movie::factory()->for($company, 'producer')->create(['name' => 'Barbie']);

    $response = $this->getJson(route('api.movies.list', ['name' => 'dark']));

    $response->assertOk()
        ->assertJson(
            fn(AssertableJson $json) =>
            $json->has('data', 1)
                ->has('meta')
                ->has('links')
        );

    expect($response->json('data.0.name'))->toBe('The Dark Knight');
});
