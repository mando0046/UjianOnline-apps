<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // pastikan sudah install barryvdh/laravel-dompdf

class AdminController extends Controller
{
    // Dashboard utama admin
    public function index()
    {
        $jumlahPeserta = User::where('role', 'peserta')->count();
        $jumlahSoal = Question::count();

        return view('dashboard.admin', compact('jumlahPeserta', 'jumlahSoal'));
    }

    // Daftar peserta (termasuk guest)
    public function pesertaDashboard()
    {
        $users = User::whereIn('role', ['peserta', 'guest'])->paginate(10);

        return view('dashboard.admin-peserta', compact('users'));
    }

    // Halaman hasil ujian semua peserta
    public function hasil()
{
    $totalSoal = Question::count();
    $users = User::with('answers')->where('role', 'peserta')->get();

    $hasilPeserta = $users->map(function ($user) use ($totalSoal) {
        $benar = 0;
        foreach ($user->answers as $jawaban) {
            if ($jawaban->question && $jawaban->answer === $jawaban->question->answer) {
                $benar++;
            }
        }

        return [
            'nama' => $user->name,
            'email' => $user->email,
            'benar' => $benar,
            'total' => $totalSoal,
            'nilai' => $totalSoal > 0 ? ($benar / $totalSoal) * 100 : 0,
           
        ];
    });

    return view('admin.hasil', compact('hasilPeserta', 'totalSoal'));
}
public function resetHasil()
{
    // Hapus semua hasil ujian dari tabel exam_attempts (atau tabel hasil yang kamu pakai)
    \DB::table('exam_attempts')->truncate();

    return redirect()->back()->with('success', '✅ Semua hasil ujian berhasil direset.');
}

public function hasilPdf()
{
    $totalSoal = Question::count();
    $users = User::with('answers')->where('role', 'peserta')->get();

    $hasilPeserta = $users->map(function ($user) use ($totalSoal) {
        $benar = 0;
        foreach ($user->answers as $jawaban) {
            if ($jawaban->question && $jawaban->answer === $jawaban->question->answer) {
                $benar++;
            }
        }

        return [
            'nama' => $user->name,
            'email' => $user->email,
            'benar' => $benar,
            'total' => $totalSoal,
            'nilai' => $totalSoal > 0 ? ($benar / $totalSoal) * 100 : 0,

        ];
    });

    $pdf = Pdf::loadView('admin.hasil_pdf', compact('hasilPeserta', 'totalSoal'));
    return $pdf->download('rekap_hasil_ujian.pdf');
}
}
