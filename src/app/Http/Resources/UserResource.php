<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'favorite_movies' => $this->favorite_movies_names,
            'hated_movies' => $this->hated_movies_names,
        ];
    }
}
