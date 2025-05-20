<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserControllerService;
use Illuminate\Http\Request;
use Inertia\Response;

class UserListViewController extends Controller
{
    public function __construct(protected readonly UserControllerService $service)
    {
    }


    public function __invoke(Request $request): Response
    {
        return inertia('DataGridPage', $this->service->getDataForView());
    }
}
