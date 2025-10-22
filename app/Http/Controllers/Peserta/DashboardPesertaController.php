<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Score;
use App\Models\ExamResetRequest;

class DashboardPesertaController extends Controller
{
    // ==========================
    // 🏠 DASHBOARD PESERTA
    // ==========================
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        // 🔹 Ambil semua jawaban peserta
        $answers = Answer::where('user_id', $userId)->get();

        // 🔹 Total soal
        $totalQuestions = Question::count();

        // 🔹 Hitung jawaban benar
        $correctAnswers = $answers->filter(function ($answer) {
            $question = Question::find($answer->question_id);
            return $question && strtolower($question->answer) === strtolower($answer->answer);
        })->count();

        // 🔹 Hitung nilai akhir
        $scoreValue = $totalQuestions > 0
            ? round(($correctAnswers / $totalQuestions) * 100, 2)
            : 0;

        // 🔹 Cek apakah tabel answers punya kolom exam_attempt_id
        $hasExamAttemptColumn = Schema::hasColumn('answers', 'exam_attempt_id');

        // 🔹 Hitung jumlah percobaan ujian
        $examCount = $hasExamAttemptColumn
            ? Answer::where('user_id', $userId)
                ->whereNotNull('exam_attempt_id')
                ->distinct()
                ->count('exam_attempt_id')
            : Score::where('user_id', $userId)->count();

        // 🔹 Simpan atau update skor
        Score::updateOrCreate(
            ['user_id' => $userId],
            [
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctAnswers,
                'score' => $scoreValue,
            ]
        );

        // 🔹 Status ujian
        $hasTakenExam = $answers->isNotEmpty() || $examCount > 0;
        $maxAttempts = 20;

        // 🔹 Cek permintaan reset ujian pending
        $pendingRequest = ExamResetRequest::where('user_id', $userId)
            ->where('status', 'pending')
            ->exists();

        // 🔹 Kirim data ke view
        return view('peserta.dashboard', [
            'user' => $user,
            'answers' => $answers,
            'correctAnswers' => $correctAnswers,
            'totalQuestions' => $totalQuestions,
            'scoreValue' => $scoreValue,
            'hasTakenExam' => $hasTakenExam,
            'examCount' => $examCount,
            'maxAttempts' => $maxAttempts,
            'pendingRequest' => $pendingRequest,
        ]);
    }

    // ==========================
    // 📈 HALAMAN HASIL UJIAN
    // ==========================
    public function hasil()
    {
        $user = Auth::user();
        $userId = $user->id;

        $totalQuestions = Question::count();
        $answers = Answer::where('user_id', $userId)->get();

        $correctAnswers = $answers->filter(function ($answer) {
            $question = Question::find($answer->question_id);
            return $question && strtolower($question->answer) === strtolower($answer->answer);
        })->count();

        $scoreValue = $totalQuestions > 0
            ? round(($correctAnswers / $totalQuestions) * 100, 2)
            : 0;

        return view('peserta.hasil', [
            'user' => $user,
            'answers' => $answers,
            'correctAnswers' => $correctAnswers,
            'totalQuestions' => $totalQuestions,
            'scoreValue' => $scoreValue,
        ]);
    }

    // ==========================
    // 🔁 PERMINTAAN RESET UJIAN
    // ==========================
    public function requestReset()
    {
        $user = Auth::user();

        // 🔹 Cek apakah sudah ada permintaan pending
        $existing = ExamResetRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('info', 'Permintaan ujian ulang Anda sudah dikirim.');
        }

        // 🔹 Buat permintaan baru
        ExamResetRequest::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan ujian ulang berhasil dikirim.');
    }
}
