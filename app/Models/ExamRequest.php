<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'approved_attempts',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
