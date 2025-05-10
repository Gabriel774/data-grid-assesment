<?php

namespace App\Models;

use App\Enums\MovieGenre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = ['genre' => MovieGenre::class, 'release_date' => 'datetime'];

    public function producer(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'producer_id');
    }

    public function userPreferences(): BelongsToMany
    {
        return $this
            ->belongsToMany(
                User::class,
                'movie_user_preferences',
                'movie_id',
                'user_id'
            );
    }

    public function fans(): BelongsToMany
    {
        return $this->userPreferences()->wherePivot('is_fan', true);
    }

    public function haters(): BelongsToMany
    {
        return $this->userPreferences()->wherePivot('is_fan', false);
    }
}