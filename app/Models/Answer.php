<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = [
        'user_id',
        'question_id',
        'answer',
    ];

    protected $casts = [
        'user_id'     => 'integer',
        'question_id' => 'integer',
    ];

    /**
     * Relasi ke tabel questions (satu jawaban milik satu soal).
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Relasi ke tabel users (satu jawaban milik satu user).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function examAttempt()
{
    return $this->belongsTo(ExamAttempt::class);
}
}
