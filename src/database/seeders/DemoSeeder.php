<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Movie;
use App\Models\Company;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::factory()->count(10)->create();

        User::factory()->count(50)->create();

        Movie::factory()->count(50)->create([
            'producer_id' => fn() => $companies->random()->id,
        ]);
    }
}
