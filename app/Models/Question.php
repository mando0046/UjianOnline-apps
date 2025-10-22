<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'question',
        'question_image',
        'option_a',
        'option_image_a',
        'option_b',
        'option_image_b',
        'option_c',
        'option_image_c',
        'option_d',
        'option_image_d',
        'option_e',
        'option_image_e',
        'answer', // <- ini kolom kunci jawaban
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Tambahkan accessor agar lebih konsisten
    public function getCorrectAnswerAttribute()
    {
        return $this->answer;
    }
  


}

