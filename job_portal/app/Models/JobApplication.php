<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'post_job_id',
        'job_seeker_id',
        'cv', 
        'status', 
        'applied_at', 
    ];

    public function jobPost() 
    {
        return $this->belongsTo(PostJob::class, 'post_job_id');
    }

    public function jobSeekerProfile() 
    {
        return $this->belongsTo(JobSeekerProfile::class, 'job_seeker_id');
    }
}
