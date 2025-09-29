<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    /**
     * A Job belongs to an Employer.
     */
    public function employer()
    {
        return $this->belongsTo(\App\Models\Employer::class);
    }

    /**
     * A Job may have many Tags.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id");
    }
}
