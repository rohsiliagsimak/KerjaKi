<?php
namespace App\Http\Controllers;

use App\Models\PostJob;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua lowongan pekerjaan dari database
        $jobs = PostJob::query();
    
        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $jobs->where('title', 'like', '%' . $request->search . '%');
        }
    
        // Filter berdasarkan lokasi
        if ($request->has('location') && $request->location != '') {
            $jobs->where('location', $request->location);
        }
    
        // Filter berdasarkan tipe pekerjaan
        if ($request->has('job_type') && $request->job_type != '') {
            $jobs->where('job_type', $request->job_type);
        }
    
        // Filter berdasarkan gaji
        if ($request->has('salary') && $request->salary != '') {
            $salary = explode('-', $request->salary);
            $jobs->whereBetween('salary', [$salary[0], $salary[1]]);
        }
    
        // Ambil hasil pencarian
        $jobs = $jobs->get();
    
        // Ambil lokasi dan tipe pekerjaan untuk filter
        $locations = PostJob::distinct()->pluck('location'); // Ambil lokasi unik
        $jobTypes = PostJob::distinct()->pluck('job_type'); // Ambil tipe pekerjaan unik
    
        return view('welcome', compact('jobs', 'locations', 'jobTypes'));
    }
}