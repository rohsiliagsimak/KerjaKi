<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\PostJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function create($postJobId)
    {
        $jobPost = PostJob::findOrFail($postJobId);
        return view('job_seeker.applied_jobs.create', compact('jobPost', 'postJobId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_job_id' => 'required|exists:job_posts,id',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $jobSeekerProfile = \App\Models\JobSeekerProfile::where('user_id', Auth::id())->firstOrFail();
    
        $jobApplication = new JobApplication();
        $jobApplication->post_job_id = $request->post_job_id;
        $jobApplication->job_seeker_id = $jobSeekerProfile->id;
        if ($request->hasFile('cv')) {
            $jobApplication->cv = $request->file('cv')->store('cvs', 'public');
        }
        $jobApplication->status = 'pending';
        $jobApplication->applied_at = now();
        $jobApplication->save();
    
        return redirect()->route('applied_jobs.show', $jobApplication->id)
                        ->with('success', 'Job application submitted successfully.');
    }

    public function apply(Request $request, $id)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $job = PostJob::findOrFail($id);
        $jobApplication = new JobApplication();
        $jobApplication->user_id = Auth::id();
        $jobApplication->post_job_id = $job->id;
        if ($request->hasFile('cv')) {
            $jobApplication->cv = $request->file('cv')->store('cvs', 'public');
        }
        $jobApplication->status = 'pending';
        $jobApplication->save();

        // Redirect based on user role
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.applications.index')->with('success', 'Lamaran berhasil dikirim.');
        } elseif (Auth::user()->role === 'employer') {
            return redirect()->route('employer.applications.index')->with('success', 'Lamaran berhasil dikirim.');
        } elseif (Auth::user()->role === 'job_seeker') {
            return redirect()->route('job_seeker.applications.index')->with('success', 'Lamaran berhasil dikirim.');
        }

        return redirect()->route('jobs.show', $job->id)->with('success', 'Lamaran berhasil dikirim.');
    }
    
    public function someMethod()
    {
        $postJobId = 1; // Contoh ID pekerjaan
        return redirect()->route('applied_jobs.create', ['postJobId' => $postJobId]);
    }

    public function show($id)
    {
        $jobApplication = JobApplication::with('jobPost')->findOrFail($id);
        return view('job_seeker.applied_jobs.show', compact('jobApplication'));
    }
}