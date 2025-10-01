<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;

// Homepage
Route::get('/', function () {
    return view('home');
});

// Show all jobs
Route::get('/jobs', function () {
    return view('jobs.index', [
        'jobs' => Job::with('employer', 'tags')->paginate(3)
    ]);
});

// Show single job
Route::get('/jobs/{job}', function (\App\Models\Job $job) {
    return view('jobs.show', ['job' => $job]);
})->name('jobs.show');

// Show Edit Form
Route::get('/jobs/{job}/edit', function (Job $job) {
    return view('jobs.edit', [
        'job' => $job,
        'employers' => Employer::all(),
        'tags' => Tag::all(),
    ]);
})->name('jobs.edit');

// Update a Job
Route::patch('/jobs/{job}', function (Job $job) {
    // validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required', 'numeric'],
        'employer_id' => ['required', 'exists:employers,id'],
        'tags' => ['required', 'array'],
    ]);

    // update job
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => request('employer_id'),
    ]);

    // sync tags
    $job->tags()->sync(request('tags'));

    // redirect back to job details
    return redirect()->route('jobs.show', $job->id);
})->name('jobs.update');

// Delete a Job
Route::delete('/jobs/{job}', function (\App\Models\Job $job) {
    $job->delete();
    return redirect('/jobs'); // back to list after deleting
})->name('jobs.destroy');



