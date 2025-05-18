<?php

namespace App\Http\Controllers\Movie;

use App\Services\MovieControllerService;
use Illuminate\Http\Request;
use App\Repositories\Contracts\MovieRepositoryInterface;
use App\Http\Resources\MovieResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Controller;

class MovieListController extends Controller
{
    public function __construct(protected readonly MovieControllerService $service)
    {
    }


    public function __invoke(Request $request, MovieRepositoryInterface $repository): JsonResource
    {
        $results = $repository
            ->setQueryFilters($this->service->getFiltersFormatted(forPipeline: true))
            ->paginate($request->input('per_page', 10), $request->input('page', 1));
        

        return MovieResource::collection($results);
    }

}
