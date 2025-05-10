<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;


uses(RefreshDatabase::class)->beforeEach(function () {
    User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    User::factory()->create([
        'name' => 'Jane Smith',
        'email' => 'jane@example.com',
    ]);

    User::factory()->create([
        'name' => 'Alice',
        'email' => 'alice@another.com',
    ]);
});

test('it returns paginated list of users with correct structure', function () {
    $response = $this->getJson(route('api.users.list'));

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'email',
                    'favorite_movies',
                    'hated_movies',
                ],
            ],
            'meta',
            'links',
        ])
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data', 3)
                ->hasAll(['meta', 'links'])
        );
});

test('it filters users by name', function () {
    $response = $this->getJson(route('api.users.list', ['name' => 'Jane']));

    $response->assertOk()
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data', 1)
                ->where('data.0.name', 'Jane Smith')
                ->hasAll(['meta', 'links'])
        );
});

test('it filters users by email', function () {
    $response = $this->getJson(route('api.users.list', ['email' => 'alice']));

    $response->assertOk()
        ->assertJson(
            fn (AssertableJson $json) =>
            $json->has('data', 1)
                ->where('data.0.email', 'alice@another.com')
                ->hasAll(['meta', 'links'])
        );
});
