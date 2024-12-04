<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\PostJob;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index(PostJob $job)
    {
        $applicants = $job->applications()->with('user')->latest()->paginate(10);
        return view('employer.applicants.index', compact('job', 'applicants'));
    }

    public function updateStatus(JobApplication $application, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Status pelamar berhasil diperbarui!');
    }
} 