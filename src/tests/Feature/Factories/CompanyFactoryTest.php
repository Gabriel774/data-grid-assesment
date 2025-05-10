<?php

use App\Models\Company;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

uses(RefreshDatabase::class);

test('company factory creates valid company', function () {
    $company = Company::factory()->has(Movie::factory()->count(3))->create();

    expect($company)->toBeInstanceOf(Company::class)
        ->and($company->name)->tobeString()
        ->and($company->movies)->toBeInstanceOf(Collection::class)
        ->and($company->movies)->toHaveCount(3)
        ->and($company->movies)->each->toBeInstanceOf(Movie::class);
});