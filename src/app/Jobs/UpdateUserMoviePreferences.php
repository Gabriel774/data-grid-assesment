<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateUserMoviePreferences implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function handle(): void
    {
        $movie = Movie::inRandomOrder()->first();

        if (!$movie) {
            return;
        }

        $isFan = (bool) random_int(0, 1);

        $this->user->moviePreferences()->syncWithoutDetaching([
            $movie->id => ['is_fan' => $isFan],
        ]);
    }
}