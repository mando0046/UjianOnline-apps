<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\ExamAttempt;

class PesertaController extends Controller
{
    // ================== 🧾 Daftar Peserta (Admin) ==================
    public function daftar()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.peserta', compact('users'));
    }

    // ================== 🏠 Dashboard Peserta ==================
 public function index()
    {
        $user = Auth::user();

        // Hitung jumlah ujian yang sudah dilakukan peserta
        $examCount = ExamAttempt::where('user_id', $user->id)->count();

        // Batas maksimal ujian
        $maxAttempts = 3; // ganti sesuai kebutuhan (misal 3x percobaan)

        // Sudah ujian atau belum (misal kalau ada minimal 1 attempt selesai)
        $hasTakenExam = ExamAttempt::where('user_id', $user->id)
            ->where('finished', true)
            ->exists();

        // Kirim semua variabel ke view
        return view('peserta.dashboard', compact(
            'examCount',
            'maxAttempts',
            'hasTakenExam'
        ));
    }


    // ================== 🧩 Halaman Ujian ==================
    public function ujian()
    {
        $userId = Auth::id();
        $attempts = ExamAttempt::where('user_id', $userId)->count();

        if ($attempts >= 5) {
            return redirect()->route('peserta.dashboard')
                ->with('error', 'Anda sudah mencapai batas maksimal 5 kali ujian.');
        }

        $attempt = ExamAttempt::create([
            'user_id'        => $userId,
            'attempt_number' => $attempts + 1,
            'finished'       => false,
        ]);

        $duration = 60; // menit
        return view('peserta.ujian', compact('duration', 'attempt'));
    }

    // ================== 🔁 Load Soal (AJAX) ==================
    public function showAjax(Request $request)
    {
        $index = (int) $request->query('index', 0);
        $soal = Question::skip($index)->take(1)->first();

        if (!$soal) {
            return response("<div class='text-red-600 font-bold'>Soal tidak ditemukan.</div>", 404);
        }

        return view('peserta.partials.soal', compact('soal'));
    }

    // ================== 💾 Simpan Jawaban Sementara ==================
    public function saveAnswer(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        foreach ($request->answers as $questionId => $answerText) {
            Answer::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'question_id' => $questionId,
                ],
                [
                    'answer' => strtolower(trim($answerText)),
                ]
            );
        }

        return response()->json(['status' => 'ok']);
    }

    // ================== ✅ Submit Ujian ==================
    public function submit(Request $request)
    {
        $userId = Auth::id();

        $attempt = ExamAttempt::where('user_id', $userId)->latest()->first();

        if ($attempt) {
            $attempt->update(['finished' => true]);
        }

        return response()->json([
            'status'  => 'ok',
            'message' => 'Ujian berhasil disubmit!',
            'user_id' => $userId,
            'attempt' => $attempt->attempt_number ?? null,
        ]);
    }

    // ================== 📊 Hasil Ujian ==================
    public function hasil()
    {
        $user = Auth::user();

        $answers = Answer::with('question')
            ->where('user_id', $user->id)
            ->get();

        $totalSoal = Question::count();
        $benar = $answers->filter(fn($ans) =>
            $ans->question && strtolower($ans->answer) === strtolower($ans->question->answer)
        )->count();

        $salah = $answers->count() - $benar;
        $belumDijawab = $totalSoal - $answers->count();
        $nilaiAkhir = $totalSoal > 0 ? round(($benar / $totalSoal) * 100, 2) : 0;
        $skor = $benar * 2;

        return view('peserta.hasil', compact(
            'user',
            'answers',
            'totalSoal',
            'benar',
            'salah',
            'belumDijawab',
            'nilaiAkhir',
            'skor'
        ));
    }
}
