<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSeekerSkill extends Model
{
    protected $fillable = [
        'job_seeker_id',
        'skill_level',
        'name', 
    ];

    public function jobSeeker() 
    {
        return $this->belongsTo(JobSeekerProfile::class);
    }
}

