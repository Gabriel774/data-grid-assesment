<?php

namespace App\Console\Commands;

use App\Jobs\UpdateUserMoviePreferences;
use Illuminate\Console\Command;
use App\Models\User;

class UpdateUsersMoviePreferences extends Command
{
    protected $signature = 'users:update-movie-preferences';
    protected $description = 'Assign random users to movies as fans or haters';

    public function handle(): int
    {
        $users = User::inRandomOrder()->limit(rand(20, 30))->get();

        foreach ($users as $user) {
            UpdateUserMoviePreferences::dispatch($user);
        }

        $this->info("Dispatched preferences update for {$users->count()} users.");

        return self::SUCCESS;
    }
}