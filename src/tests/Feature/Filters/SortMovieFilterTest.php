<?php

use App\Filters\SortMovieFilter;
use App\Models\Company;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('sorts movies by name asc', function () {
    Movie::query()->delete();

    Movie::factory()->create(['name' => 'B Movie']);
    Movie::factory()->create(['name' => 'A Movie']);

    $query = Movie::query();
    $filter = new SortMovieFilter('sort', 'name,asc');
    $results = $filter->apply($query)->get();

    expect($results->pluck('name')->take(2)->toArray())->toBe(['A Movie', 'B Movie']);
});

it('sorts movies by producer_name desc', function () {
    Movie::query()->delete();

    $companyA = Company::factory()->create(['name' => 'ZZZ Studios']);
    $companyB = Company::factory()->create(['name' => 'AAA Productions']);

    $movieA = Movie::factory()->create(['producer_id' => $companyA->id]);
    $movieB = Movie::factory()->create(['producer_id' => $companyB->id]);

    $query = Movie::query();
    $filter = new SortMovieFilter('sort', 'producer_name,desc');
    $results = $filter->apply($query)->get();

    expect($results->pluck('id')->toArray())->toBe([$movieA->id, $movieB->id]);
});

it('sorts movies by haters count desc', function () {
    Movie::query()->delete();

    $movie1 = Movie::factory()->create();
    $movie2 = Movie::factory()->create();

    $haters = User::factory()->count(5)->create();
    $movie1->haters()->attach($haters->pluck('id'), ['is_fan' => false]);

    $fewHaters = User::factory()->count(1)->create();
    $movie2->haters()->attach($fewHaters->pluck('id'), ['is_fan' => false]);

    $query = Movie::query();
    $filter = new SortMovieFilter('sort', 'haters_count,desc');
    $results = $filter->apply($query)->get();

    expect($results->first()->id)->toBe($movie1->id);
});

it('returns original query when sort value is null or empty', function () {
    $originalQuery = Movie::query();

    $filter = new SortMovieFilter('sort', null);
    $resultQuery = $filter->apply(clone $originalQuery);
    expect($resultQuery->toSql())->toBe($originalQuery->toSql());

    $filter = new SortMovieFilter('sort', '');
    $resultQuery = $filter->apply(clone $originalQuery);
    expect($resultQuery->toSql())->toBe($originalQuery->toSql());
});
