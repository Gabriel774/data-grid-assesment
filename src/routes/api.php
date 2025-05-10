<?php

use App\Http\Controllers\MovieListController;

Route::group(['as' => 'api.'], function () {
    Route::get('/movies', MovieListController::class)->name('movies.list');
});