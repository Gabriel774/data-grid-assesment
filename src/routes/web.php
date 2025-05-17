<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
})->name('home');


Route::get('/musics', function () {
    return inertia('Home');
})->name('music.list');


Route::get('/users', function () {
    return inertia('Home');
})->name('user.list');