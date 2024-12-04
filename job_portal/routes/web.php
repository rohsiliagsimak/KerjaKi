<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employer\DashboardController;
use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\JobSeekerProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\EmployerMiddleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Other routes...

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth' , 'verified')->group(function () {
    Route::get('/job-seeker/profiles', [JobSeekerProfileController::class, 'index'])->name('job_seeker.profile.index');
    Route::get('/job-seeker/profile/create', [JobSeekerProfileController::class, 'create'])->name('job_seeker.profile.create');
    Route::post('/job-seeker/profile/store', [JobSeekerProfileController::class, 'store'])->name('job_seeker.profile.store');
    Route::get('/job-seeker/profile/edit/{id}', [JobSeekerProfileController::class, 'edit'])->name('job_seeker.profile.edit');
    Route::patch('/job-seeker/profile/{id}', [JobSeekerProfileController::class, 'update'])->name('job_seeker.profile.update');
    Route::get('/job-seeker/profile/{id}', [JobSeekerProfileController::class, 'show'])->name('job_seeker.profile.show');
    Route::delete('/job-seeker/profile/{id}', [JobSeekerProfileController::class, 'destroy'])->name('job_seeker.profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('admin', AdminController::class);
    Route::resource('employers', EmployerProfileController::class);
    Route::get('/jobs/{id}', [PostJobController::class, 'show'])->name('jobs.show');
});

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
//     // Route::get('/admin/applications', [AdminApplica Route::patch('/admin/applications/{id}/status', [AdminApplicantController::class, 'updateStatus'])->name('admin.applications.updateStatus');ntController::class, 'index'])->name('admin.applications.index');
// });


Route::middleware(['auth', EmployerMiddleware::class])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/jobs', [PostJobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [PostJobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [PostJobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}', [PostJobController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{job}/edit', [PostJobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [PostJobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [PostJobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/create', [EmployerProfileController::class, 'create'])->name('create');
    Route::post('/', [EmployerProfileController::class, 'store'])->name('store');
});

// Route::middleware(['auth', 'role:employer'])->group(function () {
//     Route::get('/employer/jobs', [PostJobController::class, 'index'])->name('employer.jobs.index');
//     Route::get('/employer/jobs/create', [PostJobController::class, 'create'])->name('employer.jobs.create');
//     Route::post('/employer/jobs', [PostJobController::class, 'store'])->name('employer.jobs.store');
//     Route::get('/employer/jobs/{job}/edit', [PostJobController::class, 'edit'])->name('employer.jobs.edit');
//     Route::patch('/employer/jobs/{job}', [PostJobController::class, 'update'])->name('employer.jobs.update');
//     Route::delete('/employer/jobs/{job}', [PostJobController::class, 'destroy'])->name('employer.jobs.destroy');
// });

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // Route::get('/admin/applications', [AdminApplicantController::class, 'index'])->name('admin.applications.index');
    // Route::patch('/admin/applications/{id}/status', [AdminApplicantController::class, 'updateStatus'])->name('admin.applications.updateStatus');
});

Route::middleware(['auth', RoleMiddleware::class . ':employer'])->group(function () {
    Route::get('/employer/jobs', [PostJobController::class, 'index'])->name('employer.jobs.index');
    Route::get('/employer/jobs/create', [PostJobController::class, 'create'])->name('employer.jobs.create');
    Route::post('/employer/jobs', [PostJobController::class, 'store'])->name('employer.jobs.store');
    Route::get('/employer/jobs/{job}/edit', [PostJobController::class, 'edit'])->name('employer.jobs.edit');
    Route::patch('/employer/jobs/{job}', [PostJobController::class, 'update'])->name('employer.jobs.update');
    Route::delete('/employer/jobs/{job}', [PostJobController::class, 'destroy'])->name('employer.jobs.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/jobs/{id}', [PostJobController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{id}/apply', [JobApplicationController::class, 'apply'])->name('jobs.apply');
});

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('applied_jobs/create/{postJobId}', [JobApplicationController::class, 'create'])->name('applied_jobs.create');
//     Route::post('applied_jobs', [JobApplicationController::class, 'store'])->name('applied_jobs.store');
//     Route::get('applied_jobs/{id}', [JobApplicationController::class, 'show'])->name('applied_jobs.show');
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('employer/{id}', [EmployerProfileController::class, 'show'])->name('employers.show');
    Route::post('employer', [EmployerProfileController::class, 'store'])->name('employers.store');
});

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/admin/applications', [AdminController::class, 'applications'])->name('admin.applications.index');
//     Route::patch('/admin/applications/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.applications.updateStatus');
//     Route::get('/employer/applications', [EmployerProfileController::class, 'applications'])->name('employer.applications.index');
//     Route::patch('/employer/applications/{id}/status', [EmployerProfileController::class, 'updateStatus'])->name('employer.applications.updateStatus');
// });


Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/applications', [AdminController::class, 'applications'])->name('admin.applications.index');
    Route::patch('/admin/applications/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.applications.updateStatus');
});

Route::middleware(['auth', 'verified', RoleMiddleware::class . ':employer'])->group(function () {
    Route::get('/employer/applications', [EmployerProfileController::class, 'applications'])->name('employer.applications.index');
    Route::patch('/employer/applications/{id}/status', [EmployerProfileController::class, 'updateStatus'])->name('employer.applications.updateStatus');
    // Route::get('/employer/applications', [EmployerProfileController::class, 'applications'])->name('employer.applications.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/job-seeker/applications', [JobSeekerProfileController::class, 'applications'])->name('job_seeker.applications.index');
});

require __DIR__.'/auth.php';