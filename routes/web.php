<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

// Homepage
Route::get('/', function () {
    return view('home');
});

// Job Resource Routes (all 7 CRUD routes)
Route::resource('jobs', JobController::class);
