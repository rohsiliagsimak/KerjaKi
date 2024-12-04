<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Menampilkan daftar semua pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.index_user', compact('users'));
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('admin.create-user');
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,employer,job_seeker',
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Mengarahkan kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }

    // Menampilkan detail pengguna berdasarkan ID
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', compact('user'));
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    // Memperbarui pengguna di database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:admin,employer,job_seeker',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Memperbarui data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        // Mengarahkan kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    // Menghapus pengguna dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Mengarahkan kembali ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }

    // Menampilkan daftar aplikasi pekerjaan
    public function applications()
    {
        $applications = JobApplication::with('job', 'jobSeeker')->get();
        return view('admin.applications.index', compact('applications'));
    }

    // Memperbarui status aplikasi pekerjaan
    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        // Memperbarui status aplikasi
        $application = JobApplication::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        // Mengarahkan kembali ke halaman daftar aplikasi dengan pesan sukses
        return redirect()->route('admin.applications.index')->with('success', 'Application status updated successfully.');
    }
}