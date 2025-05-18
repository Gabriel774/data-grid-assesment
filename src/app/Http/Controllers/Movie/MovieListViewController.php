<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Services\MovieControllerService;
use Illuminate\Http\Request;
use Inertia\Response;

class MovieListViewController extends Controller
{
    public function __construct(protected readonly MovieControllerService $service)
    {
    }


    public function __invoke(Request $request): Response
    {
        return inertia('DataGridPage', $this->service->getDataForView());
    }
}
