<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    protected $fillable = [
        'title',
        'location',
        'job_type',
        'contact_email', 
        'contact_phone',
        'description',
        'requirements',
        'salary',
        'status',
        'employer_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function employer() 
    {
        return $this->belongsTo(EmployerProfile::class);
    }

    public function jobApplication() 
    {
        return $this->hasMany(JobApplication::class, 'post_job_id');
    }
    
}
