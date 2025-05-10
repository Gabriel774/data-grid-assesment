<?php

namespace App\Models;

use App\Enums\MovieGenre;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = ['genre' => MovieGenre::class, 'release_date' => 'datetime'];

    public function producer(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'producer_id');
    }
}