<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Di sini Anda bisa menambahkan logika untuk dashboard employer
        // Misalnya mengambil data lowongan kerja yang telah dipost
        return view('employer.dashboard.index-employer');
    }
}
