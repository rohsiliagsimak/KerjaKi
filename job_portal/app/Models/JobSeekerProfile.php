<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerProfile extends Model
{
    use HasFactory;

    protected $table = 'jobseeker_profiles';

    protected $fillable = [
        'user_id',
        'full_name',
        'date_of_birth', 
        'gender', 
        'phone', 
        'address', 
        'bio',
        'cv',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function skills() 
    {
        return $this->hasMany(JobSeekerSkill::class, 'job_seeker_id');
    }

    public function jobApplication() 
    {
        return $this->hasMany(JobApplication::class, 'job_seeker_id');
    }

    public function ratings() 
    {
        return $this->hasMany(Rating::class, 'job_seeker_id');
    }
}
