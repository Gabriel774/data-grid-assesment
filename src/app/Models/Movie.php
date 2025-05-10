<?php

namespace App\Models;

use App\Enums\MovieGenre;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = ['genre' => MovieGenre::class];
}