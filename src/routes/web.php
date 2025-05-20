<?php

use App\Http\Controllers\Movie\MovieListViewController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Response;

Route::get('/', fn(): Response => inertia('Home'))->name('home');

Route::get('/movies', MovieListViewController::class)->name('movies.list');

Route::get('/users', function () {
    return inertia('Home');
})->name('user.list');

Route::get('mass-create-data', function () {
    Artisan::call('db:seed');
})->name('mass-create-data');