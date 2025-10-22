<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamReset extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'reason',
        'admin_note',
        'allowed_attempts',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
