<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_description',
        'industry',
        'website', 
        'phone', 
        'address', 
        'logo',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    // public function ratings() 
    // {
    //     return $this->hasMany(Rating::class);
    // }

}

