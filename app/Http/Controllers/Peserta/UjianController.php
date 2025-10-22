<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Score;

class UjianController extends Controller
{
    /**
     * Halaman awal ujian (termasuk generate soal)
     */
 public function index()
{
    $user = Auth::user();

    // 🔹 Ambil data sesi ujian
    $examQuestions = session('exam_questions');
    $examStartTime = session('exam_start_time');

    // 🔹 Durasi ujian (menit)
    $duration = 30;

    // 🔹 Jika belum ada sesi ujian, buat baru
    if (!$examQuestions || !is_array($examQuestions) || count($examQuestions) === 0) {
        $examQuestions = Question::inRandomOrder()->pluck('id')->toArray();

        session([
            'exam_questions' => $examQuestions,
            'exam_start_time' => now(),
            'answered_questions' => [],
        ]);

        $examStartTime = now();
    }

    // 🔹 Hitung waktu tersisa dalam detik
    $elapsed = now()->diffInSeconds($examStartTime);
    $remainingTime = max(($duration * 60) - $elapsed, 0);

    // 🔹 Ambil soal sesuai urutan di session
    $questions = Question::whereIn('id', $examQuestions)
        ->orderByRaw('FIELD(id, ' . implode(',', $examQuestions) . ')')
        ->get();

    return view('peserta.partials.ujian', [
        'questions' => $questions,
        'duration' => $duration,
        'remainingTime' => $remainingTime,
    ]);
}



    /**
     * Menampilkan soal via AJAX berdasarkan index
     */
    public function showAjax(Request $request)
    {
        $index = (int) $request->get('index', 0);
        $questions = session('exam_questions');

        // Jika belum ada session, buat ulang
        if (!$questions || !is_array($questions) || count($questions) === 0) {
            $questions = Question::inRandomOrder()->pluck('id')->toArray();
            session(['exam_questions' => $questions]);
            Log::warning('Session soal kosong, dibuat ulang', ['count' => count($questions)]);
        }

        // Cek index valid
        if (!isset($questions[$index])) {
            return response('<div class="p-4 text-center text-gray-500">❌ Soal tidak ditemukan (index '.$index.').</div>', 404);
        }

        $questionId = $questions[$index];
        $question = Question::find($questionId);

        if (!$question) {
            return response('<div class="p-4 text-center text-gray-500">❌ Soal tidak ditemukan di database (ID '.$questionId.').</div>', 404);
        }

        $answer = Answer::where('user_id', Auth::id())
            ->where('question_id', $questionId)
            ->first();

        // render partial soal
        return view('peserta.partials.soal-ajax', compact('question', 'answer', 'index'));
    }

    /**
     * Menyimpan jawaban sementara
     */
  public function saveAnswer(Request $request)
{
    try {
        // Validasi data masuk
        $data = $request->validate([
            'question_id' => 'required|integer|exists:questions,id',
            'answer' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Simpan atau update jawaban
        Answer::updateOrCreate(
            [
                'user_id' => $user->id,
                'question_id' => $data['question_id'],
            ],
            [
                'answer' => strtolower(trim($data['answer'])),
                'updated_at' => now(),
            ]
        );

        return response()->json([
            'status' => 'ok',
            'message' => '✅ Jawaban berhasil disimpan!',
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'message' => '❌ Data tidak valid: ' . $e->getMessage(),
        ], 422);

    } catch (\Exception $e) {
        \Log::error('Gagal menyimpan jawaban', [
            'error' => $e->getMessage(),
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat menyimpan jawaban.',
        ], 500);
    }
}



    /**
     * Submit ujian (hitung skor dan simpan)
     */
public function submit(Request $request)
{
    $user = Auth::user();

    // 🔹 Ambil daftar soal dari session
    $questionIds = session('exam_questions', []);

    // 🔹 Jika session hilang, ambil semua soal dari database
    $questions = Question::whereIn('id', $questionIds)->get();
    if ($questions->isEmpty()) {
        $questions = Question::all();
    }

    $benar = 0;
    $salah = 0;
    $kosong = 0;

    foreach ($questions as $q) {
        // 🔹 Ambil jawaban peserta
        $answer = Answer::where('user_id', $user->id)
            ->where('question_id', $q->id)
            ->first();

        if (!$answer) {
            // Belum dijawab → simpan kosong
            Answer::create([
                'user_id' => $user->id,
                'question_id' => $q->id,
                'answer' => '',
            ]);
            $kosong++;
        } else {
            $ans = strtolower(trim($answer->answer ?? ''));

            if ($ans === '') {
                $kosong++;
            } elseif ($ans === strtolower(trim($q->correct_answer))) {
                $benar++;
            } else {
                $salah++;
            }
        }
    }

    // 🔹 Hitung total dan nilai
    $totalSoal = $questions->count();
    $nilaiAkhir = $totalSoal > 0 ? round(($benar / $totalSoal) * 100, 2) : 0;

    // 🔹 Hitung percobaan keberapa
    $attemptNumber = Score::where('user_id', $user->id)->count() + 1;

    // 🔹 Simpan hasil ke tabel scores
    Score::create([
        'user_id' => $user->id,
        'attempt_number' => $attemptNumber,
        'correct_answers' => $benar,
        'total_questions' => $totalSoal,
        'score' => $nilaiAkhir,
    ]);

    // 🔹 Hapus session ujian (tanpa hapus jawaban lama)
    session()->forget(['exam_questions', 'exam_start_time', 'answered_questions']);

    // 🔹 Kembalikan respons ke frontend
    return response()->json([
        'status' => 'ok',
        'message' => "✅ Ujian selesai!\nBenar: {$benar}, Salah: {$salah}, Kosong: {$kosong}, Nilai: {$nilaiAkhir}",
        'redirect' => route('peserta.ujian.cekJawaban'),
    ]);
}


public function hasil()
{
    $user = Auth::user();

    // 🔹 Ambil hasil ujian terakhir dari tabel scores
    $latestScore = \App\Models\Score::where('user_id', $user->id)
        ->latest('created_at')
        ->first();

    // 🔹 Ambil semua jawaban user (untuk ditampilkan jika perlu)
    $answers = \App\Models\Answer::where('user_id', $user->id)
        ->with('question')
        ->get();

    // 🔹 Hitung jumlah benar, salah, kosong
    $benar = $answers->filter(function ($ans) {
        return strtolower(trim($ans->answer ?? '')) === strtolower(trim($ans->question->correct_answer ?? ''));
    })->count();

    $salah = $answers->filter(function ($ans) {
        return $ans->answer !== '' && strtolower(trim($ans->answer)) !== strtolower(trim($ans->question->correct_answer ?? ''));
    })->count();

    $kosong = $answers->where('answer', '')->count();

    $totalSoal = $answers->count();

    return view('peserta.hasil', compact(
        'latestScore',
        'answers',
        'benar',
        'salah',
        'kosong',
        'totalSoal'
    ));
}



public function cekJawaban()
{
    $user = Auth::user();

    // Ambil data score terakhir
    $score = \App\Models\Score::where('user_id', $user->id)
        ->latest()
        ->first();

    if (!$score) {
        return redirect()->route('peserta.dashboard')->with('error', 'Belum ada hasil ujian.');
    }

    // Hitung jumlah benar, salah, kosong
    $answers = \App\Models\Answer::where('user_id', $user->id)->get();
    $total_questions = \App\Models\Question::count();
    $correct_answers = $score->correct_answers ?? 0;
    $answered_questions = $answers->where('answer', '!=', '')->count();
    $wrong_answers = $answered_questions - $correct_answers;
    $unanswered = $total_questions - $answered_questions;

    return view('peserta.hasil', [
        'total_questions' => $total_questions,
        'correct_answers' => $correct_answers,
        'wrong_answers' => $wrong_answers,
        'unanswered' => $unanswered,
        'score' => $score->score,
    ]);
}




}
