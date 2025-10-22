<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    use HasFactory;

    protected $table = 'exam_attempts'; // pastikan tabelnya sesuai dengan database kamu

    protected $fillable = [
        'user_id',
        'attempt_number',
        'finished',
    ];

    protected $casts = [
        'finished' => 'boolean',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Optional: Jika kamu ingin method reset di model ini langsung.
     */
    public static function resetAll()
    {
        static::truncate();
    }
}
