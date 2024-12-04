<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployerProfile;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmployerProfileController extends Controller
{
    public function index()
    {
        $users = User::with('employerProfile')->where('role', 'employer')->get();
        return view('employer.jobs.index', compact('users'));
    }

    public function create()
    {
        return view('employer.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string',
            'industry' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|url|max:255',
        ]);
    
        $employerProfile = new EmployerProfile();
        $employerProfile->user_id = Auth::id();
        $employerProfile->company_name = $request->company_name;
        $employerProfile->company_description = $request->company_description;
        $employerProfile->industry = $request->industry;
        $employerProfile->website = $request->website;
        $employerProfile->phone = $request->phone;
        $employerProfile->address = $request->address;
        $employerProfile->logo = $request->logo;
        $employerProfile->save();
    
        return redirect()->route('employers.show', $employerProfile->id)
                        ->with('success', 'Employer profile created successfully.');
    }

    public function show($id)
    {
        $employerProfile = EmployerProfile::where('user_id', $id)->firstOrFail();
        $user = User::findOrFail($id);
        return view('employer.profile.show', compact('employerProfile', 'user'));
    }

    // public function show($id)
    // {
    //     $employerProfile = EmployerProfile::where('user_id', $id)->first();
    //     $user = User::find($id); // Ambil data user berdasarkan ID

    //     return view('employer.profile.edit', compact('employerProfile', 'user')); // Kirimkan variabel ke tampilan
    // }

    public function edit($id)
    {
        $employerProfile = EmployerProfile::where('user_id', $id)->first();
    $user = User::find($id); // Ambil data user berdasarkan ID

    return view('employer.profile.edit', compact('employerProfile', 'user')); // Kirimkan variabel ke tampilan
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:15',
            'website' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'logo' => 'nullable|string|max:255',
        ]);
        
        $employerProfile = EmployerProfile::where('user_id', $id)->firstOrFail();
        $employerProfile->update([
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'industry' => $request->industry,
            'website' => $request->website,
            'phone' => $request->phone,
            'address' => $request->address,
            'logo' => $request->logo,
        ]);

        return redirect()->route('employers.show', $employerProfile->user_id)->with('success', 'Employer profile updated successfully.');
    }

    public function destroy($id)
    {
        $employer = EmployerProfile::findOrFail($id);
        $employer->delete();

        return redirect()->route('employers.index')->with('success', 'Employer profile deleted successfully.');
    }
    
    public function applications()
    {
        $applications = JobApplication::whereHas('job', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('job', 'jobSeeker')->get();
        return view('employer.applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $application = JobApplication::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        return redirect()->route('employer.applications.index')->with('success', 'Application status updated successfully.');
    }

    
}