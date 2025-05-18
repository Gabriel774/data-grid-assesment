<?php

use App\Http\Controllers\Movie\MovieListController;
use App\Http\Controllers\UserListController;

Route::group(['as' => 'api.'], function () {
    Route::get('/movies', MovieListController::class)->name('movies.list');
    Route::get('/users', UserListController::class)->name('users.list');
});