<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'answers'; // pastikan nama tabel sesuai dengan database kamu
    protected $fillable = [
        'id',
        'user_id',
        'question_id',
        'exam_attempt_id',
        'answer',
        'created_at',
        'updated_at'    
    ];
}
