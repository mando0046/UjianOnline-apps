<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'questions'; // nama tabel (bisa kamu sesuaikan)

     use HasFactory;

    protected $fillable = [
        'question',      // teks soal
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'answer',
        'jawaban_benar', // huruf a/b/c/d/e
    ];
    // Relasi: satu soal bisa punya banyak jawaban dari peserta
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');        }                                                                    
}
