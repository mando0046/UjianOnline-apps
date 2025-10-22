<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data sederhana untuk dashboard admin
        $totalPeserta = \App\Models\User::where('role', 'peserta')->count();
        $totalSoal = \App\Models\Question::count();
        $totalUjian = \App\Models\ExamAttempt::count();

        return view('admin.dashboard', compact('totalPeserta', 'totalSoal', 'totalUjian'));

    }
}
