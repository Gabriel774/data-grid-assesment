<?php

use App\Enums\MovieGenre;
use App\Filters\WhereInFilter;
use App\Models\Movie;
use App\Models\Company;
use App\Filters\FilterPipeline;


test('filter pipeline applies genre and producer filters', function () {
    $companyA = Company::factory()->create();
    $companyB = Company::factory()->create();

    Movie::factory()->for($companyA, 'producer')->create(['genre' => MovieGenre::COMEDY]);
    Movie::factory()->for($companyB, 'producer')->create(['genre' => MovieGenre::ACTION]);
    Movie::factory()->count(2)->for($companyA, 'producer')->create(['genre' => MovieGenre::ACTION]);

    $pipeline = new FilterPipeline(
        new WhereInFilter('genre', MovieGenre::ACTION->value),
        new WhereInFilter('producer_id', $companyA->id)
    );

    $query = Movie::query();
    $result = $pipeline->applyTo($query)->get();

    expect($result)->toHaveCount(2);
    expect($result->pluck('genre')->unique())->toEqual(collect([MovieGenre::ACTION]));
    expect($result->pluck('producer_id')->unique())->toEqual(collect([$companyA->id]));
});
