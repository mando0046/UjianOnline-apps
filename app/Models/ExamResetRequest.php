<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResetRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'reason',
        'type',              // 🆕 Jenis permintaan: reset_exam / extra_time
        'requested_minutes', // 🆕 Jumlah menit tambahan jika type = extra_time
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk filter berdasarkan jenis permintaan
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
