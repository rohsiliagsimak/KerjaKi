<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('admin.index');
            } elseif (Auth::user()->role == 'employer') {
                return view('employer.index');
            }
    
            return view('job_seeker.index');
    
        } else {
            // return redirect('login');
            return view('admin.index');
        }
    }
}

