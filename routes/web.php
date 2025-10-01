<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

// Homepage
Route::get('/', function () {
    return view('home');
});

// All Jobs
Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::with('employer', 'tags')->paginate(3) 
    ]);
});

// Single Job
Route::get('/jobs/{id}', function ($id) {
    return view('job', [
        'job' => Job::find($id)
    ]);
});
