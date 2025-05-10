<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function moviePreferences(): BelongsToMany
    {
        return $this->belongsToMany(
            Movie::class,
            'movie_user_preferences',
            'user_id',
            'movie_id'
        )->withPivot('is_fan');
    }

    public function favoriteMovies(): BelongsToMany
    {
        return $this->moviePreferences()->wherePivot('is_fan', true);
    }

    public function hatedMovies(): BelongsToMany
    {
        return $this->moviePreferences()->wherePivot('is_fan', false);
    }
}
