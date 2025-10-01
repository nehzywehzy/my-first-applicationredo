<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index() {
        $jobs = Job::with('employer', 'tags')->paginate(3);
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create() {
        return view('jobs.create', [
            'employers' => Employer::all(),
            'tags' => Tag::all()
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric'],
            'employer_id' => ['required', 'exists:employers,id'],
            'tags' => ['required', 'array'],
        ]);

        $job = Job::create($request->only('title', 'salary', 'employer_id'));
        $job->tags()->sync($request->tags);

        return redirect()->route('jobs.show', $job->id);
    }

    public function show(Job $job) {
        return view('jobs.show', ['job' => $job]);
    }

    public function edit(Job $job) {
        return view('jobs.edit', [
            'job' => $job,
            'employers' => Employer::all(),
            'tags' => Tag::all(),
        ]);
    }

    public function update(Request $request, Job $job) {
        $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric'],
            'employer_id' => ['required', 'exists:employers,id'],
            'tags' => ['required', 'array'],
        ]);

        $job->update($request->only('title', 'salary', 'employer_id'));
        $job->tags()->sync($request->tags);

        return redirect()->route('jobs.show', $job->id);
    }

    public function destroy(Job $job) {
        $job->delete();
        return redirect()->route('jobs.index');
    }
}