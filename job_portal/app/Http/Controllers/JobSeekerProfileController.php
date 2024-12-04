<?php
namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobSeekerProfile;
use App\Models\JobSeekerSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobSeekerProfileController extends Controller
{
    // Menampilkan form untuk membuat profil pencari kerja baru
    public function create()
    {
        return view('job_seeker.profiles.create');
    }

    // Menyimpan profil pencari kerja baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:15',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:255',
        ]);

            // Membuat instance baru dari JobSeekerProfile
            $jobSeekerProfile = new JobSeekerProfile();
            $jobSeekerProfile->user_id = Auth::id();
            $jobSeekerProfile->full_name = $request->full_name;
            $jobSeekerProfile->date_of_birth = $request->date_of_birth;
            $jobSeekerProfile->gender = $request->gender;
            $jobSeekerProfile->phone = $request->phone;
            $jobSeekerProfile->address = $request->address;
            $jobSeekerProfile->bio = $request->bio;
    
            // Menyimpan CV jika ada
            if ($request->hasFile('cv')) {
                if ($jobSeekerProfile->cv) {
                    Storage::disk('public')->delete($jobSeekerProfile->cv);
                }
    
                $cvPath = $request->file('cv')->store('cvs', 'public');
                $jobSeekerProfile->cv = $cvPath;
            }
    
            // Menyimpan profil pencari kerja ke database
            $jobSeekerProfile->save();

            // Menyimpan keterampilan pencari kerja jika ada
        if ($request->skills) {
            foreach ($request->skills as $skill) {
                JobSeekerSkill::create([
                    'job_seeker_id' => $jobSeekerProfile->id,
                    'name' => trim($skill),
                ]);
            }
        }

        // Mengarahkan kembali ke halaman profil dengan pesan sukses
        return redirect()->route('job_seeker.profile.show', $jobSeekerProfile->id)->with('success', 'Job Seeker profile created successfully.');
    }

    // Menampilkan profil pencari kerja berdasarkan ID
    public function show($id)
    {
        $profile = JobSeekerProfile::with('skills')->findOrFail($id);
        return view('job_seeker.profiles.show', compact('profile'));
    }

    // Menampilkan form untuk mengedit profil pencari kerja
    public function edit($id)
    {
        $profile = JobSeekerProfile::with('skills')->findOrFail($id);
        return view('job_seeker.profiles.edit', compact('profile'));
    }

    // Memperbarui profil pencari kerja di database
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:15',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
            'cv' => 'nullable|file|mimes:pdf|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:255',
        ]);

        // Mengambil profil pencari kerja berdasarkan ID
        $jobSeekerProfile = JobSeekerProfile::findOrFail($id);

        // Menyimpan CV baru jika ada
        if ($request->hasFile('cv')) {
            if ($jobSeekerProfile->cv) {
                Storage::disk('public')->delete($jobSeekerProfile->cv);
            }

            $cvPath = $request->file('cv')->store('cvs', 'public');
            $jobSeekerProfile->cv = $cvPath;
        }

        // Memperbarui profil pencari kerja di database
        $jobSeekerProfile->update([
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'bio' => $request->bio,
        ]);

        // Menghapus keterampilan lama dan menyimpan keterampilan baru jika ada
        JobSeekerSkill::where('job_seeker_id', $jobSeekerProfile->id)->delete();

        if ($request->skills) {
            foreach ($request->skills as $skill) {
                JobSeekerSkill::create([
                    'job_seeker_id' => $jobSeekerProfile->id,
                    'name' => trim($skill),
                ]);
            }
        }

        // Mengarahkan kembali ke halaman profil dengan pesan sukses
        return redirect()->route('job_seeker.profile.show', $jobSeekerProfile->id)->with('success', 'Job Seeker profile updated successfully.');
    }

    // Menghapus profil pencari kerja dari database
    public function destroy($id)
    {
        $jobSeekerProfile = JobSeekerProfile::findOrFail($id);
        $jobSeekerProfile->delete();

        return redirect()->route('job_seeker.profile.index')->with('success', 'Job Seeker profile deleted successfully.');
    }

    // Menampilkan daftar aplikasi pekerjaan yang telah dilamar oleh pencari kerja
    public function applications()
    {
        $applications = JobApplication::where('job_seeker_id', Auth::id())->with('jobPost')->get();
        return view('job_seeker.applications.index', compact('applications'));
    }
}