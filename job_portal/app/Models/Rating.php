<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'employer_id',
        'job_seeker_id',
        'rating',
        'riview',
    ];

    public function employer() 
    {
        return $this->belongsTo(EmployerProfile::class);
    }

    public function jobSeeker() 
    {
        return $this->belongsTo(JobSeekerProfile::class);
    }
}
