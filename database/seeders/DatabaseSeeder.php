<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Job;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create or fetch 10 unique tags
        $tags = collect();
        foreach (Tag::factory(10)->make() as $tag) {
            $tags->push(Tag::firstOrCreate(['name' => $tag->name]));
        }

        // Create 20 jobs and attach 2 random tags to each job
        Job::factory(20)->create()->each(function ($job) use ($tags) {
            $job->tags()->attach($tags->random(2));
        });
    }
}
