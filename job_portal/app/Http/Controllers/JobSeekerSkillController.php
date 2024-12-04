<?php

namespace App\Http\Controllers;

use App\Models\JobSeekerSkill;
use App\Models\JobSeekerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobSeekerSkillController extends Controller
{
    public function create()
    {
        return view('job_seeker.profiles.add_skills');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_seeker_skills,name',
            'skill_level' => 'required|in:beginner,intermediate,advanced,expert',
        ]);

        $skill = new JobSeekerSkill();
        $skill->job_seeker_id = Auth::user()->jobSeekerProfile->id; // Mengambil ID profil pencari kerja
        $skill->name = $request->name;
        $skill->skill_level = $request->skill_level;
        $skill->save();

        return redirect()->route('profiles.show', Auth::user()->jobSeekerProfile->id)->with('success', 'Keterampilan berhasil ditambahkan!');
    }

    
    public function edit($id)
    {
        $skill = JobSeekerSkill::findOrFail($id);
        return view('job_seeker.skills.edit', compact('skill')); // Tampilkan form untuk mengedit keterampilan
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_seeker_skills,name,' . $id,
            'skill_level' => 'required|in:beginner,intermediate,advanced,expert',
        ]);

        $skill = JobSeekerSkill::findOrFail($id);
        $skill->name = $request->name;
        $skill->skill_level = $request->skill_level;
        $skill->save();

        return redirect()->route('profiles.show', Auth::user()->jobSeekerProfile->id)->with('success', 'Keterampilan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $skill = JobSeekerSkill::findOrFail($id);
        $skill->delete();

        return redirect()->route('profiles.show', Auth::user()->jobSeekerProfile->id)->with('success', 'Keterampilan berhasil dihapus!');
    }
    
}