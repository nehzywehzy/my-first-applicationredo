<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employer;
use App\Models\Tag;
use Illuminate\Http\Request;


class JobController extends Controller
{
    // Show all jobs
    public function index()
    {
        $jobs = Job::with('employer', 'tags')->paginate(3);
        return view('jobs.index', compact('jobs'));
    }

    // Show a single job
    public function show($id)
    {
        $job = Job::with('employer', 'tags')->findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    // Show create form
    public function create()
    {
        return view('jobs.create', [
            'employers' => Employer::all(),
            'tags' => Tag::all()
        ]);
    }

    // Store new job
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric', 'min:0'],
            'employer_id' => ['required', 'exists:employers,id'],
            'tags' => ['required', 'array'],
        ]);

        $job = Job::create($request->only('title', 'salary', 'employer_id'));
        $job->tags()->attach($request->tags);

        return redirect('/jobs')->with('success', 'Job created successfully!');
    }

    // Show edit form
    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'job' => $job,
            'employers' => Employer::all(),
            'tags' => Tag::all()
        ]);
    }

    // Update job
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric', 'min:0'],
            'employer_id' => ['required', 'exists:employers,id'],
            'tags' => ['required', 'array'],
        ]);

        // Update main job fields
        $job->update($request->only('title', 'salary', 'employer_id'));

        // Sync tags
        $job->tags()->sync($request->tags);

        return redirect()->route('jobs.show', $job->id)->with('success', 'Job updated successfully!');
    }

    // Delete job
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs')->with('success', 'Job deleted successfully!');
    }
}
