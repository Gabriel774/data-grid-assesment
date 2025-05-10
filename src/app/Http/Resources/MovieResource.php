<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'producer' => [
                'name' => $this->producer->name,
            ],
            'genre' => $this->genre,
            'release_date' => $this->release_date->toDateString(),
            'synopsis' => $this->synopsis,
            'fans_count' => $this->fans()->count(),
            'haters_count' => $this->haters()->count(),
        ];
    }
}
