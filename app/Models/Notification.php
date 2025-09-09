<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $casts = [
    'sent_at' => 'datetime',
    'created_at' => 'datetime',
    ];

    protected $fillable = [
        'title', 'message', 'type', 'student_id', 'user_id', 'read', 'sent_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
