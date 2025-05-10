<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\UserControllerService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserListController extends Controller
{
    public function __construct(protected readonly UserControllerService $service)
    {
    }


    public function __invoke(Request $request, UserRepositoryInterface $repository): JsonResource
    {
        $results = $repository
            ->setQueryFilters($this->service->getFiltersForPipeline())
            ->paginate($request->input('per_page', 10), $request->input('page', 1));

        return UserResource::collection($results);
    }

}
