<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'specialization'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classroomSubjects()
    {
        return $this->hasMany(ClassroomSubjectTeacher::class);
    }
}
