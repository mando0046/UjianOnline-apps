<?php

namespace App\Livewire;

use Livewire\Component;


use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class UjianComponent extends Component
{
    public $questions = [];
    public $current = 0;
    public $jawaban = []; // [question_id => 'a/b/c/d/e']
    public $waktu; // detik, default 15 menit = 900 detik

    protected $listeners = ['timerEnded' => 'submitUjian'];

   public function mount($waktu = 900)
{
    // Ambil soal urut dari id terkecil ke terbesar, reset index array
    $this->questions = Question::orderBy('id')->get()->values();

    $this->waktu = $waktu;

    // Load jawaban sebelumnya, tapi index disesuaikan berdasarkan posisi soal
    $answers = Answer::where('user_id', Auth::id())
        ->pluck('answer', 'question_id')
        ->toArray();

    foreach ($this->questions as $index => $question) {
        if (isset($answers[$question->id])) {
            $this->jawaban[$index] = $answers[$question->id];
        }
    }
}

    // Navigasi soal
    public function goTo($index)
    {
        if ($index >= 0 && $index < count($this->questions)) {
            $this->current = $index;
        }
    }

    public function next()
    {
        if ($this->current < count($this->questions) - 1) {
            $this->current++;
        }
    }

    public function prev()
    {
        if ($this->current > 0) {
            $this->current--;
        }
    }

    // Simpan jawaban
   public function submitUjian()
{
    $userId = Auth::id();

    $this->validate([
        'jawaban.*' => 'nullable|in:a,b,c,d,e'
    ]);

    foreach ($this->jawaban as $index => $answer) {
        $questionId = $this->questions[$index]->id;

        Answer::updateOrCreate(
            ['user_id' => $userId, 'question_id' => $questionId],
            ['answer' => $answer ?? null]
        );
    }

    session()->flash('message', 'Jawaban berhasil disimpan!');
}

    public function render()
    {
        return view('livewire.ujian-component', [
            'question' => $this->questions[$this->current] ?? null,
            'totalQuestions' => count($this->questions),
        ]);
    }
}
