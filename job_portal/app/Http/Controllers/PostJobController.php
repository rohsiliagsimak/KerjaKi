<?php

// path/to/PostJobController.php

namespace App\Http\Controllers;

use App\Models\PostJob; // Pastikan model Job diimpor
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\EmployerProfile;

class PostJobController extends Controller
{
    // Menampilkan daftar lowongan pekerjaan
    public function index()
    {
        $jobs = PostJob::all(); 
        return view('employer.jobs.index', compact('jobs')); // Mengirim data ke view
    }

    // Menampilkan form untuk membuat lowongan pekerjaan
    public function create()
    {
        return view('employer.jobs.create');
    }

    // Menyimpan lowongan pekerjaan ke database
    public function store(Request $request)
    {
        Log::info('Job Type:', ['job_type' => $request->input('job_type')]);

        if (!Auth::check()) { // Ganti auth()->check() dengan Auth::check()
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat lowongan.');
        }

        // Validasi data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,freelance', 
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary' => 'required|numeric|min:1000|max:999999999999.99',
            'status' => 'required|string|in:active,closed,draft',
        ]);

        // Simpan data ke database
        $job = new PostJob(); // Pastikan menggunakan model yang benar
        $job->title = $request->input('title');
        $job->location = $request->input('location');
        $job->job_type = $request->input('job_type');
        $job->contact_email = $request->input('contact_email');
        $job->contact_phone = $request->input('contact_phone');
        $job->description = $request->input('description');
        $job->requirements = $request->input('requirements');
        $job->salary = $request->input('salary');
        $job->employer_id = Auth::user()->id; 

        // Validasi employer_id sebelum menyimpan
        // if (!EmployerProfile::find($job->employer_id)) {
        //     return response()->json(['error' => 'Employer ID is invalid.'], 400);
        // }
        
        $job->save();
    
        return redirect()->route('employer.jobs.index')->with('success', 'Lowongan berhasil dibuat!');
    
    }
    // Menampilkan form untuk mengedit lowongan pekerjaan
    public function edit($id)
    {
        $job = PostJob::findOrFail($id); // Mencari lowongan berdasarkan ID
        return view('employer.jobs.edit', compact('job')); // Mengirim data ke view
    }

    // Memperbarui lowongan pekerjaan di database
    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'job_type' => 'required|in:full-time,part-time,freelance',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'requirements' => 'required|string',
            'salary' => 'required|numeric|min:1000',
            'status' => 'required|string|in:active,closed,draft',
        ]);

        $job = PostJob::findOrFail($id); // Mencari lowongan berdasarkan ID
        $job->title = $validatedData['title'];
        $job->description = $validatedData['description'];
        $job->job_type = $validatedData['job_type'];
        $job->contact_email = $validatedData['contact_email'];
        $job->contact_phone = $validatedData['contact_phone'];
        $job->requirements = $validatedData['requirements'];
        $job->salary = $validatedData['salary'];
        $job->status = $validatedData['status'];
        
        $job->save(); // Pastikan ini dipanggil

        return redirect()->route('employer.jobs.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function show($id)
    {
        $job = PostJob::findOrFail($id);
        return view('employer.jobs.show', compact('job'));
    }

    // Menghapus lowongan pekerjaan dari database
    public function destroy($id)
    {
        $job = PostJob::findOrFail($id); // Mencari lowongan berdasarkan ID
        $job->delete(); // Menghapus lowongan

        return redirect()->route('employer.jobs.index')->with('success', 'Lowongan berhasil dihapus!');
    }
}
