<?php

namespace Database\Factories;

use App\Enums\MovieGenre;
use App\Models\Movie;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition(): array
    {
        return [
            'producer_id' => Company::factory(),
            'name' => $this->faker->sentence(3),
            'release_date' => $this->faker->date(),
            'synopsis' => $this->faker->text(200),
            'genre' => $this->faker->randomElement(MovieGenre::cases())->value,
        ];
    }
}