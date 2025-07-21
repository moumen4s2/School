<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomSubjectTeacher extends Model
{
    /** @use HasFactory<\Database\Factories\ClassroomSubjectTeacherFactory> */
    use HasFactory;
    protected $fillable = ['classroom_id', 'subject_id', 'teacher_id'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
