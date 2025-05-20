<?php

use App\Http\Controllers\Movie\MovieListViewController;
use App\Http\Controllers\User\UserListViewController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Response;

Route::get('/', fn(): Response => inertia('Home'))->name('home');

Route::get('/movies', MovieListViewController::class)->name('movies.list');

Route::get('/users', UserListViewController::class)->name('user.list');

Route::get('mass-create-data', function () {
    Artisan::call('db:seed');
})->name('mass-create-data');