<?php

use App\Filters\FilterTemplate;
use Tests\Stubs\DummyFilter;

test('it returns the correct query filter instance', function () {
    $request = Request::create('/movies', 'GET', ['genre' => 'action']);
    app()->instance('request', $request);

    $template = new FilterTemplate(
        value: 'genre',
        label: 'Genre',
        queryFilter: DummyFilter::class,
        inputType: 'select',
        queryColumn: 'genre_column'
    );

    $filter = $template->toQueryFilter();

    expect($filter)->toBeInstanceOf(DummyFilter::class)
        ->and($filter->column)->toBe('genre_column')
        ->and($filter->value)->toBe('action');
});