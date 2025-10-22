<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\ExamResetRequest;
use App\Models\Question;
use App\Models\Exam;

class DashboardController extends Controller
{
    /**
     * 🔹 Tampilkan halaman dashboard peserta.
     */
    public function index()
    {
        $userId = Auth::id();

        // Cek apakah peserta sudah pernah mengerjakan ujian
        $hasTakenExam = Answer::where('user_id', $userId)->exists();

        // Hitung jumlah jawaban yang sudah disimpan (jumlah soal yang dikerjakan)
        $examCount = Answer::where('user_id', $userId)->count();

        // Batas maksimum percobaan ujian (bisa disesuaikan)
        $maxAttempts = 25;

        // Cek apakah peserta memiliki permintaan reset yang sudah disetujui admin
        $resetApproved = ExamResetRequest::where('user_id', $userId)
                            ->where('status', 'approved')
                            ->exists();

        // Ambil daftar soal hanya jika belum ujian atau reset disetujui
        $questions = [];
        if (!$hasTakenExam || $resetApproved) {
            $questions = Question::all();
        }

        // Durasi ujian dalam menit
        $duration = 60;

        return view('peserta.dashboard', compact(
            'hasTakenExam',
            'examCount',
            'maxAttempts',
            'resetApproved',
            'questions',
            'duration'
        ));
    }

    /**
     * 🔹 Kirim permintaan reset ujian oleh peserta.
     */
    public function requestExamReset(Request $request)
    {
        $userId = Auth::id();

        // Validasi input alasan (opsional)
        $request->validate([
            'reason' => 'nullable|string|max:255',
        ]);

        // Cegah peserta mengirim permintaan ganda sebelum disetujui
        $existingRequest = ExamResetRequest::where('user_id', $userId)
                            ->whereIn('status', ['pending', 'approved'])
                            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', '❗ Kamu sudah memiliki permintaan reset yang masih aktif.');
        }

        // Simpan permintaan baru
        ExamResetRequest::create([
            'user_id' => $userId,
            'reason'  => $request->input('reason', 'Permintaan reset ujian'),
            'status'  => 'pending', // default menunggu persetujuan admin
        ]);

        return redirect()->back()->with('success', '✅ Permintaan reset ujian berhasil dikirim dan menunggu persetujuan admin.');
    }
}
